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
    $request->validate([
        'produk_id'        => ['required', 'exists:produks,id'],
        'jenis_kemasan_id' => ['required', 'exists:jenis_kemasans,id'],
        'palet_warna_id'   => ['required', 'exists:palet_warnas,id'],
        'instruksi_ai'     => ['nullable', 'string'],
    ]);

    $produk = Produk::where('user_id', Auth::id())
        ->findOrFail($request->produk_id);

    $jenisKemasan = JenisKemasan::findOrFail($request->jenis_kemasan_id);
    $paletWarna = PaletWarna::findOrFail($request->palet_warna_id);

    $prompt = "
    Kamu adalah desainer kemasan profesional untuk produk UMKM.

    Buatkan konsep desain kemasan yang detail berdasarkan informasi berikut:

    Nama Produk: {$produk->nama_produk}
    Jenis Kemasan: {$jenisKemasan->nama_kemasan}
    Palet Warna: {$paletWarna->nama_warna}
    Instruksi Tambahan: {$request->instruksi_ai}

    Jelaskan:

    1. Konsep utama desain
    2. Warna dominan
    3. Tipografi yang cocok
    4. Elemen visual yang digunakan
    5. Tata letak kemasan depan
    6. Target market
    7. Material kemasan yang direkomendasikan
    8. Kesan yang ingin ditampilkan

    Buat hasil yang profesional dan mudah dipahami.
    ";

    try {

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.key'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4.1-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Kamu adalah ahli desain kemasan dan branding produk.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 800,
        ]);

        if (!$response->successful()) {

            return back()->with(
                'error',
                'OpenAI Error: ' . $response->body()
            );
        }

        $generatedText =
            $response->json()['choices'][0]['message']['content'] ?? null;

        if (!$generatedText) {
            return back()->with(
                'error',
                'AI tidak mengembalikan hasil.'
            );
        }

        $desain = Desain::create([
            'produk_id'        => $produk->id,
            'jenis_kemasan_id' => $request->jenis_kemasan_id,
            'palet_warna_id'   => $request->palet_warna_id,
            'judul_desain'     => $produk->nama_produk,
            'status_desain'    => 'generated',
            'hasil_ai'         => $generatedText,
        ]);

        return redirect()
            ->route('desain.show', $desain->id)
            ->with('success', 'Ide kemasan berhasil dibuat!');

    } catch (\Exception $e) {

        return back()->with(
            'error',
            'Error: ' . $e->getMessage()
        );
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

        $desain->delete();

        return redirect()->route('desain.index')->with('success', 'Desain berhasil dihapus!');
    }

    public function generateAjax(Request $request)
    {
        // 1. Validasi input dari Javascript
        $request->validate([
            'prompt'           => ['required', 'string'],
            'jenis_kemasan_id' => ['required', 'exists:jenis_kemasans,id'],
            'palet_warna_id'   => ['required', 'exists:palet_warnas,id'],
        ]);

        // 2. Ambil nama asli dari database
        $jenisKemasan = JenisKemasan::find($request->jenis_kemasan_id);
        $paletWarna = PaletWarna::find($request->palet_warna_id);

        $kemasanNama = $jenisKemasan ? $jenisKemasan->nama_kemasan : "Kemasan Standar"; 
        $warnaNama = $paletWarna ? $paletWarna->nama_warna : "Warna Bebas";
        $userPrompt = $request->input('prompt');

        // 3. Gabungkan jadi Prompt utuh
        $fullPrompt = "Sebagai ahli desain kemasan (UI/UX dan Branding), berikan 3 konsep ide desain kemasan dengan detail berikut:\n"
                    . "- Jenis Wadah: {$kemasanNama}\n"
                    . "- Palet Warna: {$warnaNama}\n"
                    . "- Instruksi Spesifik: {$userPrompt}\n\n"
                    . "Jelaskan dengan format poin-poin yang singkat dan menarik.";

        // 4. Panggil API Gemini dengan model versi terbaru yang aktif (Gemini 2.5 Flash)
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
                
                return response()->json([
                    'success' => true, 
                    'data' => $resultText
                ]);
            }

            return response()->json([
            'success' => false, 
            'message' => 'Error Gemini: ' . $response->body() . ' | Cek API Key: ' . substr($apiKey, 0, 5) . '...'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Koneksi terputus: ' . $e->getMessage()
            ], 500);
        }
    }
}