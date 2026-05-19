<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\JenisKemasan;
use App\Models\PaletWarna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Tampilkan semua produk milik user
    public function index()
    {
        $produks = Produk::where('user_id', Auth::id())
                        ->with('desains')
                        ->orderBy('created_at', 'asc')
                        ->get();

        return view('produk.index', compact('produks'));
    }

    // Tampilkan form tambah produk (step 1: info produk)
    public function create()
    {
        return view('produk.create');
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'     => ['required', 'string', 'max:255'],
            'tagline'         => ['nullable', 'string', 'max:255'],
            'deskripsi_produk'=> ['nullable', 'string'],
            'kategori_produk' => ['required', 'string'],
            'gambar_logo'     => ['nullable', 'image', 'max:5120'], // max 5MB
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar_logo')) {
            $gambarPath = $request->file('gambar_logo')->store('logos', 'public');
        }

        $produk = Produk::create([
            'user_id'          => Auth::id(),
            'nama_produk'      => $request->nama_produk,
            'tagline'          => $request->tagline,
            'deskripsi_produk' => $request->deskripsi_produk,
            'kategori_produk'  => $request->kategori_produk,
            'gambar_logo'      => $gambarPath,
        ]);

        // Redirect ke step 2: pilih kemasan & palet warna
        return redirect()->route('produk.pilih-kemasan', $produk->id);
    }

    // Tampilkan form pilih kemasan & palet warna (step 2)
    public function pilihKemasan($id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);
        $jenisKemasans = JenisKemasan::all();
        $paletWarnas = PaletWarna::all();

        return view('produk.pilih-kemasan', compact('produk', 'jenisKemasans', 'paletWarnas'));
    }

    // Tampilkan detail produk
    public function show($id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    // Tampilkan form edit produk
    public function edit($id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nama_produk'      => ['required', 'string', 'max:255'],
            'tagline'          => ['nullable', 'string', 'max:255'],
            'deskripsi_produk' => ['nullable', 'string'],
            'kategori_produk'  => ['required', 'string'],
            'gambar_logo'      => ['nullable', 'image', 'max:5120'],
        ]);

        $gambarPath = $produk->gambar_logo;
        if ($request->hasFile('gambar_logo')) {
            // Hapus gambar lama
            if ($gambarPath) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar_logo')->store('logos', 'public');
        }

        $produk->update([
            'nama_produk'      => $request->nama_produk,
            'tagline'          => $request->tagline,
            'deskripsi_produk' => $request->deskripsi_produk,
            'kategori_produk'  => $request->kategori_produk,
            'gambar_logo'      => $gambarPath,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);

        if ($produk->gambar_logo) {
            Storage::disk('public')->delete($produk->gambar_logo);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}