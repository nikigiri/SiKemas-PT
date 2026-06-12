<?php

namespace App\Http\Controllers;

use App\Models\Desain;
use App\Models\Produk;
use App\Models\JenisKemasan;
use App\Models\PaletWarna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DesainController extends Controller
{
    public function index()
    {
        $desains = Desain::whereHas('produk', function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('created_at', 'desc')->get();

        return view('desain.index', compact('desains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id'             => ['required', 'exists:produks,id'],
            'jenis_kemasan_id'      => ['required', 'exists:jenis_kemasans,id'],
            'palet_warna_id'        => ['nullable', 'exists:palet_warnas,id'],
            'instruksi_ai'          => ['nullable', 'string'],
            'desain_id'             => ['nullable', 'exists:desains,id'],
            'custom_warna_utama'    => ['required_if:use_custom_color,1', 'nullable', 'string'],
            'custom_warna_sekunder' => ['required_if:use_custom_color,1', 'nullable', 'string'],
            'custom_warna_aksen'    => ['required_if:use_custom_color,1', 'nullable', 'string'],
        ]);

        $produk = Produk::where('user_id', Auth::id())->findOrFail($request->produk_id);
        $jenisKemasan = JenisKemasan::findOrFail($request->jenis_kemasan_id);
        
        // Cek apakah pakai custom color atau preset
        if ($request->use_custom_color && !$request->palet_warna_id) {
            // Cari dulu apakah kombinasi warna ini sudah ada
            $paletWarna = PaletWarna::where('warna_utama', $request->custom_warna_utama)
                ->where('warna_sekunder', $request->custom_warna_sekunder)
                ->where('warna_aksen', $request->custom_warna_aksen)
                ->first();

            // Kalau belum ada, buat baru
            if (!$paletWarna) {
                $paletWarna = PaletWarna::create([
                    'nama_palet'     => 'Custom - ' . auth()->user()->name,
                    'warna_utama'    => $request->custom_warna_utama,
                    'warna_sekunder' => $request->custom_warna_sekunder,
                    'warna_aksen'    => $request->custom_warna_aksen,
                    'kode_hex'       => $request->custom_warna_utama,
                ]);
            }
        } else {
            $paletWarna = PaletWarna::findOrFail($request->palet_warna_id);
        }

        try {
            $promptTeks = "Buatkan konsep desain kemasan yang detail berdasarkan informasi berikut:

            Nama Produk    : {$produk->nama_produk}
            Jenis Kemasan  : {$jenisKemasan->nama_kemasan}
            Palet Warna    : {$paletWarna->nama_warna}
            Instruksi      : {$request->instruksi_ai}

            Jelaskan: konsep utama, warna dominan, tipografi, elemen visual, tata letak, target market, material, kesan.
            Buat hasil yang profesional dan mudah dipahami.
            ";

            $generatedText = "Konsep desain sedang diproses. Silakan cek mockup visual di atas.";

            $imagePrompt = $this->generateImagePrompt($produk, $jenisKemasan, $paletWarna);
            $mockupUrl   = $this->buildPollinationsUrl($imagePrompt);

            if ($request->desain_id) {
                $desain = Desain::where('produk_id', $produk->id)->findOrFail($request->desain_id);
                $desain->update([
                    'jenis_kemasan_id' => $request->jenis_kemasan_id,
                    'palet_warna_id'   => $paletWarna->id,
                    'hasil_ai'         => $generatedText,
                    'mockup_url'       => $mockupUrl,
                    'status_desain'    => 'generated',
                ]);
            } else {
                $desain = Desain::create([
                    'produk_id'        => $produk->id,
                    'jenis_kemasan_id' => $request->jenis_kemasan_id,
                    'palet_warna_id'   => $paletWarna->id,
                    'judul_desain'     => $produk->nama_produk,
                    'status_desain'    => 'generated',
                    'hasil_ai'         => $generatedText,
                    'mockup_url'       => $mockupUrl,
                ]);
            }

            return redirect()->route('desain.show', $desain->id)->with('success', 'Kemasan berhasil digenerate!');

        } catch (\Exception $e) {
            return back()->with('error', 'Koneksi terputus: ' . $e->getMessage());
        }
    }
    
    public function show($id)
    {
        $desain = Desain::whereHas('produk', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['produk', 'jenisKemasan', 'paletWarna', 'elemens'])->findOrFail($id);

        return view('desain.show', compact('desain'));
    }

    public function destroy($id)
    {
        $desain = Desain::whereHas('produk', function ($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);

        $produk_id = $desain->produk_id;

        $desain->delete();

        return redirect()->route('produk.show', $produk_id)->with('success', 'Desain berhasil dihapus!');
    }

    private function callGroq(string $systemPrompt, string $userPrompt): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.groq.api_key'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model'    => 'llama-3.3-70b-versatile',
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user',   'content' => $userPrompt],
            ],
            'max_tokens' => 1024,
        ]);

        if (!$response->successful()) {
            throw new \Exception('Groq Error: ' . $response->body());
        }

        $text = $response->json()['choices'][0]['message']['content'] ?? null;

        if (!$text) {
            throw new \Exception('AI tidak mengembalikan hasil.');
        }

        return $text;
    }

    private function generateMockupUrl(Produk $produk, JenisKemasan $jenisKemasan, PaletWarna $paletWarna): string
    {
        $prompt = urlencode(
            "professional product packaging design, " .
            $jenisKemasan->nama_kemasan . " packaging, " .
            $produk->nama_produk . " product, " .
            "color palette " . $paletWarna->warna_utama . " and " . $paletWarna->warna_sekunder . ", " .
            "minimalist modern design, white background, studio lighting, product mockup"
        );

        return "https://image.pollinations.ai/prompt/{$prompt}?width=512&height=640&nologo=true";
    }

    private function generateImagePrompt(Produk $produk, JenisKemasan $jenisKemasan, PaletWarna $paletWarna): string
    {
        return "realistic professional product packaging mockup, " .
            $jenisKemasan->nama_kemasan . " type packaging, " .
            "product name " . $produk->nama_produk . ", " .
            ($produk->tagline ? "tagline " . $produk->tagline . ", " : "") .
            "dominant colors " . $paletWarna->warna_utama . " " . $paletWarna->warna_sekunder . " " . $paletWarna->warna_aksen . ", " .
            "minimalist modern label design, studio lighting, white background, photorealistic, 8k, commercial product photography";
    }

    private function buildPollinationsUrl(string $imagePrompt): string
    {
        $encoded = rawurlencode($imagePrompt);
        $seed = rand(1, 999999);
        return "https://image.pollinations.ai/prompt/{$encoded}?width=768&height=1024&nologo=true&seed={$seed}";
    }
}