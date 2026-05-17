<?php

namespace App\Http\Controllers;

use App\Models\Desain;
use App\Models\Produk;
use App\Models\JenisKemasan;
use App\Models\PaletWarna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesainController extends Controller
{
    // Tampilkan semua desain milik user
    public function index()
    {
        $desains = Desain::whereHas('produk', function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('created_at', 'desc')->get();

        return view('desain.index', compact('desains'));
    }

    // Simpan pilihan kemasan & palet warna lalu generate
    public function store(Request $request)
    {
        $request->validate([
            'produk_id'        => ['required', 'exists:produks,id'],
            'jenis_kemasan_id' => ['required', 'exists:jenis_kemasans,id'],
            'palet_warna_id'   => ['required', 'exists:palet_warnas,id'],
        ]);

        $produk = Produk::where('user_id', Auth::id())->findOrFail($request->produk_id);

        $desain = Desain::create([
            'produk_id'        => $produk->id,
            'jenis_kemasan_id' => $request->jenis_kemasan_id,
            'palet_warna_id'   => $request->palet_warna_id,
            'judul_desain'     => $produk->nama_produk,
            'status_desain'    => 'draft',
        ]);

        return redirect()->route('desain.show', $desain->id);
    }

    // Tampilkan hasil desain
    public function show($id)
    {
        $desain = Desain::whereHas('produk', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['produk', 'jenisKemasan', 'paletWarna', 'elemens'])->findOrFail($id);

        return view('desain.show', compact('desain'));
    }

    // Hapus desain
    public function destroy($id)
    {
        $desain = Desain::whereHas('produk', function ($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);

        $desain->delete();

        return redirect()->route('desain.index')->with('success', 'Desain berhasil dihapus!');
    }
}