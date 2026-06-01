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
    // =============================================
    // HELPER: Panggil Groq API (dipakai di 2 tempat)
    // =============================================
    private function callGroq(string $systemPrompt, string $userPrompt): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.groq.api_key'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model'      => 'llama-3.3-70b-versatile',
            'messages'   => [
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

    // =============================================
    public function index()
    {
        $desains = Desain::whereHas('produk', function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('created_at', 'desc')->get();

        return view('desain.index', compact('desains'));
    }

    // =============================================
    // STORE: Generate + simpan ke database
    // =============================================
    public function store(Request $request)
    {
        $request->validate([
            'produk_id'        => ['required', 'exists:produks,id'],
            'jenis_kemasan_id' => ['required', 'exists:jenis_kemasans,id'],
            'palet_warna_id'   => ['required', 'exists:palet_warnas,id'],
            'instruksi_ai'     => ['nullable', 'string'],
        ]);

        $produk       = Produk::where('user_id', Auth::id())->findOrFail($request->produk_id);
        $jenisKemasan = JenisKemasan::findOrFail($request->jenis_kemasan_id);
        $paletWarna   = PaletWarna::findOrFail($request->palet_warna_id);

        $prompt = "
        Buatkan konsep desain kemasan yang detail berdasarkan informasi berikut:

        Nama Produk    : {$produk->nama_produk}
        Jenis Kemasan  : {$jenisKemasan->nama_kemasan}
        Palet Warna    : {$paletWarna->nama_warna}
        Instruksi      : {$request->instruksi_ai}

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
            $generatedText = $this->callGroq(
                'Kamu adalah ahli desain kemasan dan branding produk UMKM.',
                $prompt
            );

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
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

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
}