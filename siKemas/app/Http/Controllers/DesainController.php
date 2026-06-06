<?php

namespace App\Http\Controllers;

use App\Models\Desain;
use App\Models\Produk;
use App\Models\JenisKemasan;
use App\Models\PaletWarna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        // 1. Validasi Input
        $request->validate([
            'produk_id'        => ['required', 'exists:produks,id'],
            'jenis_kemasan_id' => ['required', 'exists:jenis_kemasans,id'],
            'palet_warna_id'   => ['required', 'exists:palet_warnas,id'],
<<<<<<< HEAD
            'instruksi_ai'     => ['nullable', 'string'], 
=======
            'instruksi_ai'     => ['nullable', 'string'],
            'desain_id'        => ['nullable', 'exists:desains,id'],
>>>>>>> b099451 (revisi admin & super admin)
        ]);

        // 2. Tarik data relasi untuk bahan prompt
        $produk = Produk::where('user_id', Auth::id())->findOrFail($request->produk_id);
        $jenisKemasan = JenisKemasan::findOrFail($request->jenis_kemasan_id);
        $paletWarna = PaletWarna::findOrFail($request->palet_warna_id);

        // 3. Siapkan Prompt untuk Gemini
        $prompt = "Kamu adalah asisten desainer kemasan AI. Buatkan ide konsep desain kemasan yang detail untuk produk UMKM. "
                . "Nama Produk: {$produk->nama_produk}. "
                . "Bentuk Kemasan: {$jenisKemasan->nama_kemasan}. " 
                . "Palet Warna Utama: {$paletWarna->nama_warna}. " 
                . "Instruksi/Gaya Visual Tambahan: {$request->instruksi_ai}. "
                . "Berikan rekomendasi material yang cocok, elemen grafis yang harus ada, dan kesan dari desain tersebut.";

        // 4. Eksekusi API Gemini
        $apiKey = config('services.gemini.api_key');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        try {
<<<<<<< HEAD
            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json'
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);
=======
            $generatedText = $this->callGroq(
                'Kamu adalah ahli desain kemasan dan branding produk UMKM.',
                $prompt
            );

            if ($request->desain_id) {
                $desain = Desain::where('produk_id', $produk->id)
                    ->findOrFail($request->desain_id);

                $desain->update([
                    'jenis_kemasan_id' => $request->jenis_kemasan_id,
                    'palet_warna_id'   => $request->palet_warna_id,
                    'hasil_ai'         => $generatedText,
                    'status_desain'    => 'generated',
                ]);
            } else {
                $desain = Desain::create([
                    'produk_id'        => $produk->id,
                    'jenis_kemasan_id' => $request->jenis_kemasan_id,
                    'palet_warna_id'   => $request->palet_warna_id,
                    'judul_desain'     => $produk->nama_produk,
                    'status_desain'    => 'generated',
                    'hasil_ai'         => $generatedText,
                ]);
            }
>>>>>>> b099451 (revisi admin & super admin)

            // 5. Simpan Hasilnya
            if ($response->successful()) {
                $result = $response->json();
                $generatedText = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;

                if ($generatedText) {
                    // Buat record desain baru HANYA JIKA AI sukses menjawab
                    $desain = Desain::create([
                        'produk_id'        => $produk->id,
                        'jenis_kemasan_id' => $request->jenis_kemasan_id,
                        'palet_warna_id'   => $request->palet_warna_id,
                        'judul_desain'     => $produk->nama_produk,
                        'status_desain'    => 'generated',
                        'hasil_ai'         => $generatedText 
                    ]);

                    // Pindah ke halaman hasil desain!
                    return redirect()->route('desain.show', $desain->id)->with('success', 'Ide kemasan berhasil diracik!');
                }
            }

            // Jika API gagal membalas teks yang benar
            return back()->with('error', 'Gagal memproses hasil dari AI. Coba klik lagi.');

        } catch (\Exception $e) {
            return back()->with('error', 'Koneksi terputus: ' . $e->getMessage());
        }
    }
<<<<<<< HEAD

=======
    // =============================================
    // GENERATE AJAX: Preview sebelum simpan
    // =============================================
    public function generateAjax(Request $request)
    {
        $request->validate([
            'prompt'           => ['required', 'string'],
            'jenis_kemasan_id' => ['required', 'exists:jenis_kemasans,id'],
            'palet_warna_id'   => ['required', 'exists:palet_warnas,id'],
        ]);

        $jenisKemasan = JenisKemasan::find($request->jenis_kemasan_id);
        $paletWarna   = PaletWarna::find($request->palet_warna_id);

        $kemasanNama = $jenisKemasan->nama_kemasan ?? 'Kemasan Standar';
        $warnaNama   = $paletWarna->nama_warna     ?? 'Warna Bebas';

        $fullPrompt = "Berikan 3 konsep ide desain kemasan dengan detail berikut:\n"
                    . "- Jenis Wadah      : {$kemasanNama}\n"
                    . "- Palet Warna      : {$warnaNama}\n"
                    . "- Instruksi Khusus : {$request->prompt}\n\n"
                    . "Jelaskan tiap konsep dengan poin-poin singkat dan menarik.";

        try {
            $resultText = $this->callGroq(
                'Kamu adalah ahli desain kemasan dan branding produk UMKM.',
                $fullPrompt
            );

            return response()->json([
                'success' => true,
                'data'    => $resultText,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // =============================================
>>>>>>> b099451 (revisi admin & super admin)
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
        // 1. Validasi input dari Javascript
        $request->validate([
            'prompt'           => ['required', 'string'],
            'jenis_kemasan_id' => ['nullable', 'exists:jenis_kemasans,id'],
            'palet_warna_id'   => ['nullable', 'exists:palet_warnas,id'],
            'produk_id'        => ['required', 'exists:produks,id'] // Ditambahkan karena frontend mengirim ini
        ]);

        // 2. Ambil nama asli dari database
        $jenisKemasan = JenisKemasan::find($request->jenis_kemasan_id);
        $paletWarna = PaletWarna::find($request->palet_warna_id);
        $produk = Produk::find($request->produk_id);

        $kemasanNama = $jenisKemasan ? $jenisKemasan->nama_kemasan : "Kemasan Standar"; 
        $warnaNama = $paletWarna ? $paletWarna->nama_warna : "Warna Bebas";
        $namaProduk = $produk ? $produk->nama_produk : "Produk UMKM";
        $userPrompt = $request->input('prompt');

        // 3. Gabungkan jadi Prompt utuh
        $fullPrompt = "Sebagai ahli desain kemasan (UI/UX dan Branding), berikan 3 konsep ide desain kemasan untuk produk {$namaProduk} dengan detail berikut:\n"
                    . "- Jenis Wadah: {$kemasanNama}\n"
                    . "- Palet Warna: {$warnaNama}\n"
                    . "- Instruksi Spesifik: {$userPrompt}\n\n"
                    . "Jelaskan dengan format poin-poin yang singkat dan menarik untuk pelaku UMKM.";

        // 4. Panggil API Gemini
        $apiKey = config('services.gemini.api_key');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        try {
            $response = Http::withoutVerifying()->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $fullPrompt]
                        ]
                    ]
                ]
            ]);

            // 5. Kembalikan hasil ke Javascript
            if ($response->successful()) {
                $resultText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
                
                // KITA BUNGKUS DENGAN FORMAT OPENAI AGAR JAVASCRIPT TIDAK ERROR
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
}