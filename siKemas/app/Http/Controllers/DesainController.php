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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'palet_warna_id'        => ['required', 'exists:palet_warnas,id'],
            'instruksi_ai'          => ['required', 'string'],
            'desain_id'             => ['nullable', 'exists:desains,id'],
            'use_custom_color'      => ['nullable', 'boolean'],
            'custom_warna_utama'    => ['required_if:use_custom_color,1', 'nullable', 'string'],
            'custom_warna_sekunder' => ['required_if:use_custom_color,1', 'nullable', 'string'],
            'custom_warna_aksen'    => ['required_if:use_custom_color,1', 'nullable', 'string'],
        ]);

        try {
            // Gunakan DB Transaction agar jika AI gagal, data warna tidak jadi masuk ke database
            DB::beginTransaction();

            $produk = Produk::where('user_id', Auth::id())->findOrFail($request->produk_id);
            $jenisKemasan = JenisKemasan::findOrFail($request->jenis_kemasan_id);
            
            // Logika Palet Warna
            if ($request->use_custom_color && !$request->palet_warna_id) {
                $paletWarna = PaletWarna::firstOrCreate(
                    [
                        'warna_utama'    => $request->custom_warna_utama,
                        'warna_sekunder' => $request->custom_warna_sekunder,
                        'warna_aksen'    => $request->custom_warna_aksen,
                    ],
                    [
                        'nama_palet'     => 'Custom - ' . auth()->user()->name,
                        'kode_hex'       => $request->custom_warna_utama,
                    ]
                );
            } else {
                if (!$request->palet_warna_id) {
                    throw new \Exception('Pilih palet warna.');
                }
                $paletWarna = PaletWarna::findOrFail($request->palet_warna_id);
            }

            // 1. Generate Teks Penjelasan Konsep menggunakan Gemini
            $generatedText = $this->generateDesignConcept($produk, $jenisKemasan, $paletWarna, $request->instruksi_ai);

            // 2. Generate Gambar menggunakan Gemini (sebagai Prompt Engineer) + Flux
            $mockupUrl = $this->generatePackagingImage($produk, $jenisKemasan, $paletWarna, $request->instruksi_ai);

            // 3. Simpan ke Database
            if ($request->desain_id) {
                $desain = Desain::where('produk_id', $produk->id)->findOrFail($request->desain_id);
                
                // Hapus gambar lama jika ada pembaruan
                if ($desain->mockup_url) {
                    $oldPath = str_replace('/storage/', 'public/', $desain->mockup_url);
                    Storage::delete($oldPath);
                }

                $desain->update([
                    'jenis_kemasan_id' => $jenisKemasan->id,
                    'palet_warna_id'   => $paletWarna->id,
                    'hasil_ai'         => $generatedText,
                    'mockup_url'       => $mockupUrl,
                    'status_desain'    => 'generated',
                ]);
            } else {
                $desain = Desain::create([
                    'produk_id'        => $produk->id,
                    'jenis_kemasan_id' => $jenisKemasan->id,
                    'palet_warna_id'   => $paletWarna->id,
                    'judul_desain'     => $produk->nama_produk,
                    'status_desain'    => 'generated',
                    'hasil_ai'         => $generatedText,
                    'mockup_url'       => $mockupUrl,
                ]);
            }

            DB::commit();
            return redirect()->route('desain.show', $desain->id)->with('success', 'Kemasan berhasil digenerate!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Desain Generate Error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->with('error', 'Proses gagal: ' . $e->getMessage());
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

        // Hapus file gambar dari storage saat desain dihapus
        if ($desain->mockup_url) {
            $path = str_replace('/storage/', 'public/', $desain->mockup_url);
            Storage::delete($path);
        }

        $desain->delete();

        return redirect()->route('produk.show', $produk_id)->with('success', 'Desain berhasil dihapus!');
    }

    // --- PRIVATE METHODS UNTUK AI INTEGRATION ---

    private function createImagePrompt(
    Produk $produk,
    JenisKemasan $jenisKemasan,
    PaletWarna $paletWarna,
    ?string $instruksi
): string
{
    $prompt = "
    Kamu adalah prompt engineer profesional untuk AI Image Generation.

    Produk:
    {$produk->nama_produk}

    Jenis Kemasan:
    {$jenisKemasan->nama_kemasan}

    Warna Utama:
    {$paletWarna->warna_utama}

    Warna Sekunder:
    {$paletWarna->warna_sekunder}

    Warna Aksen:
    {$paletWarna->warna_aksen}

    Instruksi Tambahan:
    {$instruksi}

    Buat prompt bahasa Inggris yang sangat detail untuk menghasilkan mockup kemasan produk profesional.

    Fokus pada:
    - branding premium
    - komposisi visual
    - tipografi
    - warna
    - material kemasan
    - studio lighting
    - photorealistic
    - commercial product photography

    Keluarkan hanya promptnya saja.
    ";

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . config('services.openai.api_key'),
        'Content-Type' => 'application/json',
    ])->post(
        'https://api.openai.com/v1/responses',
        [
            'model' => 'gpt-5.4',
            'input' => $prompt,
        ]
    );

    if ($response->failed()) {
        throw new \Exception(
            'OpenAI Prompt Error: ' . $response->body()
        );
    }

    return data_get(
        $response->json(),
        'output.0.content.0.text'
    );
}

    private function generateDesignConcept(
        Produk $produk,
        JenisKemasan $jenisKemasan,
        PaletWarna $paletWarna,
        ?string $instruksi
        ): string
    {
        $prompt = "
        Kamu adalah desainer kemasan profesional.

        Produk: {$produk->nama_produk}
        Jenis Kemasan: {$jenisKemasan->nama_kemasan}

        Warna Utama: {$paletWarna->warna_utama}
        Warna Sekunder: {$paletWarna->warna_sekunder}
        Warna Aksen: {$paletWarna->warna_aksen}

        Instruksi tambahan:
        {$instruksi}

        Buat penjelasan konsep desain kemasan dalam bahasa Indonesia.
        Jelaskan:
        1. Konsep utama
        2. Elemen visual
        3. Kesan yang ditimbulkan

        Maksimal 2 paragraf.
        ";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'Content-Type' => 'application/json',
        ])->timeout(120)
        ->post('https://api.openai.com/v1/chat/completions', [
            'model' => config('services.openai.model'), 
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
        ]);

        if ($response->failed()) {
            throw new \Exception(
                'OpenAI Text Error: ' . $response->body()
            );
        }

        return data_get($response->json(), 'choices.0.message.content');
    }

        private function generatePackagingImage(
        Produk $produk,
        JenisKemasan $jenisKemasan,
        PaletWarna $paletWarna,
        ?string $instruksi
    ): string {
        $prompt = $this->createImagePrompt($produk, $jenisKemasan, $paletWarna, $instruksi);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'Content-Type'  => 'application/json',
        ])->timeout(120)
        ->post('https://api.openai.com/v1/images/generations', [
            'model'         => 'gpt-image-1',
            'prompt'        => $prompt,
            'output_format' => 'png',  
        ]);

        if ($response->failed()) {
            throw new \Exception('OpenAI Image Error: ' . $response->body());
        }

        // gpt-image-1 tetap return b64_json meski output_format = 'png'
        $base64Image = data_get($response->json(), 'data.0.b64_json');

        if (!$base64Image) {
            // Fallback: coba ambil URL langsung jika ada
            $imageUrl = data_get($response->json(), 'data.0.url');
            if ($imageUrl) {
                return $imageUrl; // simpan URL langsung tanpa download
            }
            throw new \Exception('Gambar gagal dibuat oleh OpenAI. Response: ' . $response->body());
        }

        // Simpan ke storage
        $imageBinary = base64_decode($base64Image);
        $imageName   = 'kemasan_' . Str::random(10) . '_' . time() . '.png';

        Storage::disk('public')->put('mockups/' . $imageName, $imageBinary);

        return Storage::url('mockups/' . $imageName);
    }
}