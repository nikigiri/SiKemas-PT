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
            'palet_warna_id'        => ['nullable', 'exists:palet_warnas,id'],
            'instruksi_ai'          => ['nullable', 'string'],
            'desain_id'             => ['nullable', 'exists:desains,id'],
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

    private function generateDesignConcept(Produk $produk, JenisKemasan $jenisKemasan, PaletWarna $paletWarna, ?string $instruksi): string
    {
        $prompt = "Kamu adalah desainer kemasan profesional. Buatkan penjelasan konsep kemasan untuk produk '{$produk->nama_produk}' dengan bentuk kemasan '{$jenisKemasan->nama_kemasan}', menggunakan warna dominan '{$paletWarna->warna_utama}'. Instruksi khusus dari klien: '{$instruksi}'. Jelaskan konsep utama, elemen visual, dan kesan yang ditimbulkan dalam 2 paragraf berbahasa Indonesia yang menarik.";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . config('services.gemini.api_key'), [
            'contents' => [['parts' => [['text' => $prompt]]]]
        ]);

        if ($response->failed()) {
            throw new \Exception('Gemini Error: ' . $response->body());
        }
        return $response->json('candidates.0.content.parts.0.text');
    }

    private function generatePackagingImage(Produk $produk, JenisKemasan $jenisKemasan, PaletWarna $paletWarna, ?string $instruksi): string
    {
        // 1. Minta Gemini membuatkan Prompt Visual berbahasa Inggris
        $promptGemini = "You are an expert prompt engineer. Create a highly detailed English prompt for an AI image generator (Flux) to create a product packaging design. Product name: {$produk->nama_produk}, Packaging type: {$jenisKemasan->nama_kemasan}, Main colors: {$paletWarna->warna_utama} and {$paletWarna->warna_sekunder}. Additional notes: {$instruksi}. Focus on photorealism, commercial product photography, studio lighting, and modern minimalist design. Return ONLY the prompt text, no filler words.";

        $geminiResponse = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . config('services.gemini.api_key'), [
            'contents' => [['parts' => [['text' => $promptGemini]]]]
        ]);

        if ($geminiResponse->failed()) throw new \Exception('Gagal membuat prompt visual dari Gemini.');
        
        $englishPrompt = trim(str_replace(["\n", "\r", "*"], " ", $geminiResponse->json('candidates.0.content.parts.0.text')));

        // 2. Kirim Prompt ke FLUX.1-dev
        $fluxResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.huggingface.api_key'),
        ])->timeout(120)->post('https://api-inference.huggingface.co/models/black-forest-labs/FLUX.1-dev', [
            'inputs' => $englishPrompt
        ]);

        if ($fluxResponse->failed()) throw new \Exception('Flux API Error: Server sedang sibuk atau token tidak valid.');

        // 3. Simpan binary gambar langsung ke storage/app/public/mockups
        $imageName = 'kemasan_' . Str::random(10) . '_' . time() . '.png';
        Storage::disk('public')->put('mockups/' . $imageName, $fluxResponse->body());

        // Kembalikan URL publik untuk disimpan ke database
        return Storage::url('mockups/' . $imageName);
    }
}