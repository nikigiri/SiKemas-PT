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
            'produk_id'        => ['required', 'exists:produks,id'],
            'jenis_kemasan_id' => ['required', 'exists:jenis_kemasans,id'],
            'palet_warna_id'   => ['required', 'exists:palet_warnas,id'],
            'instruksi_ai'     => ['nullable', 'string'],
            'desain_id'        => ['nullable', 'exists:desains,id'],
        ]);

        $produk = Produk::where('user_id', Auth::id())->findOrFail($request->produk_id);
        $jenisKemasan = JenisKemasan::findOrFail($request->jenis_kemasan_id);
        $paletWarna = PaletWarna::findOrFail($request->palet_warna_id);

        try {
            // TAHAP 1: GEMINI MERACIK PROMPT (TEKS)
            $instruksiGemini = "Sebagai ahli Prompt Engineer, buatkan kalimat bahasa Inggris yang sangat deskriptif untuk AI Image Generator (FLUX). "
                             . "Tujuannya untuk membuat desain kemasan 3D. "
                             . "Nama Produk: {$produk->nama_produk}. "
                             . "Bentuk Kemasan: {$jenisKemasan->nama_kemasan}. "
                             . "Warna Dominan: {$paletWarna->nama_warna}. "
                             . "Instruksi dari user: {$request->instruksi_ai}. "
                             . "Tambahkan kata kunci: realistic packaging mockup, premium branding, modern design, high quality render, studio lighting. "
                             . "PENTING: Hanya balas dengan teks bahasa Inggrisnya saja, jangan tambahkan penjelasan atau kata pembuka apapun.";

            $promptDariGemini = $this->callGemini(
                'Kamu adalah asisten ahli yang menulis prompt untuk AI pembuat gambar.', 
                $instruksiGemini
            );

            // TAHAP 2: FLUX MEMBUAT GAMBAR BERDASARKAN GEMINI
            $responseFlux = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.huggingface.api_key'),
            ])
            ->withOptions([
                'curl' => [CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4] // Paksa IPv4 untuk atasi DNS error
            ])
            ->withoutVerifying() // Bypass SSL issue jika ada
            ->timeout(180) 
            ->post(
                'https://api-inference.huggingface.co/models/black-forest-labs/FLUX.1-schnell',
                [
                    'inputs' => $promptDariGemini
                ]
            );

            if (!$responseFlux->successful()) {
                return back()->with('error', 'Gagal memproses gambar dari Flux: ' . $responseFlux->body());
            }

            $filename = 'flux_' . time() . '.png';
            $filePath = 'designs/' . $filename;
            
            Storage::disk('public')->put($filePath, $responseFlux->body());

            // Menyimpan path gambar dan prompt racikan Gemini ke database
            if ($request->desain_id) {
                $desain = Desain::where('produk_id', $produk->id)->findOrFail($request->desain_id);
                $desain->update([
                    'jenis_kemasan_id' => $request->jenis_kemasan_id,
                    'palet_warna_id'   => $request->palet_warna_id,
                    'hasil_ai'         => $filePath, 
                    'status_desain'    => 'generated',
                ]);
            } else {
                $desain = Desain::create([
                    'produk_id'        => $produk->id,
                    'jenis_kemasan_id' => $request->jenis_kemasan_id,
                    'palet_warna_id'   => $request->palet_warna_id,
                    'judul_desain'     => $produk->nama_produk,
                    'status_desain'    => 'generated',
                    'hasil_ai'         => $filePath, 
                ]);
            }

            return redirect()->route('desain.show', $desain->id)->with('success', 'Gambar kemasan berhasil digenerate oleh kolaborasi Gemini & Flux!');

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

    public function generateGemini(Request $request)
    {
        $request->validate([
            'prompt'           => ['required', 'string'],
            'jenis_kemasan_id' => ['nullable', 'exists:jenis_kemasans,id'],
            'palet_warna_id'   => ['nullable', 'exists:palet_warnas,id'],
            'produk_id'        => ['required', 'exists:produks,id']
        ]);

        $jenisKemasan = JenisKemasan::find($request->jenis_kemasan_id);
        $paletWarna = PaletWarna::find($request->palet_warna_id);
        $produk = Produk::find($request->produk_id);

        $kemasanNama = $jenisKemasan ? $jenisKemasan->nama_kemasan : "Kemasan Standar"; 
        $warnaNama = $paletWarna ? $paletWarna->nama_warna : "Warna Bebas";
        $namaProduk = $produk ? $produk->nama_produk : "Produk UMKM";
        $userPrompt = $request->input('prompt');

        $fullPrompt = "Sebagai ahli Prompt Engineering untuk AI Image Generator (seperti FLUX), "
                    . "buatkan SATU paragraf prompt berbahasa Inggris yang sangat deskriptif berisi kata kunci (keywords) yang dipisahkan dengan koma untuk menghasilkan gambar desain kemasan 3D yang realistis. "
                    . "Ramu detail produk UMKM berikut menjadi deskripsi visual:\n"
                    . "- Nama Produk (sebagai teks pada logo/label): {$namaProduk}\n"
                    . "- Bentuk/Jenis Wadah: {$kemasanNama}\n"
                    . "- Palet Warna Dominan: {$warnaNama}\n"
                    . "- Tema/Instruksi Spesifik: {$userPrompt}\n\n"
                    . "Wajib tambahkan kata kunci visual berikut ke dalam prompt: realistic 3D packaging mockup, professional commercial product photography, aesthetic, modern minimalist branding, studio lighting, highly detailed, 8k resolution, photorealistic, sharp focus, clean neutral background.\n\n"
                    . "ATURAN SANGAT PENTING: HANYA balas dengan raw prompt berbahasa Inggris. JANGAN gunakan format poin-poin, JANGAN beri kalimat pembuka/penutup, dan JANGAN gunakan markdown.";
        
        $apiKey = config('services.gemini.api_key');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash:generateContent?key={$apiKey}";

        try {
            $response = Http::withOptions([
                'curl' => [CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4] // Paksa IPv4
            ])
            ->withoutVerifying()
            ->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $fullPrompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $resultText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
                
                return response()->json([
                    'choices' => [
                        [
                            'message' => [
                                'content' => $resultText
                            ]
                        ]
                    ]
                ]);
            }

            return response()->json([
                'choices' => [['message' => ['content' => 'Error Gemini: ' . $response->body()]]]
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'choices' => [['message' => ['content' => 'Koneksi terputus: ' . $e->getMessage()]]]
            ], 500);
        }
    }

    public function generateFlux(Request $request)
    {
        $request->validate([
            'prompt' => ['required', 'string'],
            'produk_id' => ['required', 'exists:produks,id']
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        $prompt = "
        Professional 3D packaging design for {$produk->nama_produk},
        {$request->prompt},
        realistic packaging mockup,
        premium branding,
        modern packaging,
        high quality render,
        studio lighting,
        commercial packaging design
        ";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.huggingface.api_key'),
            ])
            ->withOptions([
                'curl' => [CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4] // Paksa IPv4
            ])
            ->withoutVerifying() // Bypass SSL issue jika ada
            ->timeout(180) 
            ->post(
                'https://api-inference.huggingface.co/models/black-forest-labs/FLUX.1-schnell',
                [
                    'inputs' => $prompt
                ]
            );

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => $response->body()
                ], 500);
            }

            $filename = 'flux_' . time() . '.png';

            Storage::disk('public')->put(
                'designs/' . $filename,
                $response->body()
            );

            return response()->json([
                'success' => true,
                'image_url' => asset('storage/designs/' . $filename)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function callGemini($systemPrompt, $userPrompt)
    {
        $apiKey = config('services.gemini.api_key');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash:generateContent?key={$apiKey}";

        $fullPrompt = $systemPrompt . "\n\n" . $userPrompt;

        $response = Http::withOptions([
            'curl' => [CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4] // Paksa IPv4
        ])
        ->withoutVerifying()
        ->timeout(60) 
        ->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $fullPrompt]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            return $response->json()['candidates'][0]['content']['parts'][0]['text'];
        }

        throw new \Exception('Gagal menghubungi API Gemini: ' . $response->body());
    }
}