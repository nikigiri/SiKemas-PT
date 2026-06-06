<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\JenisKemasan;
use App\Models\PaletWarna;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::where('user_id', Auth::id())
                        ->with('desains')
                        ->orderBy('created_at', 'asc')
                        ->get();

        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        $kwtId = Auth::user()->kwt_id;

        $kategoris = Kategori::where(function ($q) use ($kwtId) {
            $q->whereNull('kwt_id')->orWhere('kwt_id', $kwtId);
        })->orderBy('nama_kategori')->get();

        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'nama_produk'      => ['required', 'string', 'max:255'],
            'tagline'          => ['nullable', 'string', 'max:255'],
            'deskripsi_produk' => ['nullable', 'string'],
            'kategori_produk'  => ['required', 'string'],
            'gambar_logo'      => ['nullable', 'image', 'max:5120'],
=======
            'nama_produk'     => ['required', 'string', 'max:255'],
            'tagline'         => ['nullable', 'string', 'max:255'],
            'deskripsi_produk'=> ['nullable', 'string'],
            'kategori_produk' => ['required', 'string'],
            'gambar_logo'     => ['nullable', 'image', 'max:5120'],
>>>>>>> b099451 (revisi admin & super admin)
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

        return redirect()->route('produk.pilih-kemasan', $produk->id);
    }

<<<<<<< HEAD
    public function pilihKemasan($id)
=======
    // Tampilkan form pilih kemasan & palet warna (step 2)
    public function pilihKemasan($id, Request $request)
>>>>>>> b099451 (revisi admin & super admin)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);

        $kwtId = Auth::user()->kwt_id;

        $jenisKemasans = JenisKemasan::where(function ($q) use ($kwtId) {
            $q->whereNull('kwt_id')->orWhere('kwt_id', $kwtId);
        })->get();

        $paletWarnas = PaletWarna::all();

        $desain = null;
        if ($request->query('desain_id')) {
            $desain = \App\Models\Desain::where('produk_id', $produk->id)
                ->find($request->query('desain_id'));
        }

        return view('produk.pilih-kemasan', compact('produk', 'jenisKemasans', 'paletWarnas', 'desain'));
    }

    public function show($id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);
<<<<<<< HEAD
        $kategoris = \App\Models\Kategori::all();
=======

        $kwtId = Auth::user()->kwt_id;

        $kategoris = Kategori::where(function ($q) use ($kwtId) {
            $q->whereNull('kwt_id')->orWhere('kwt_id', $kwtId);
        })->orderBy('nama_kategori')->get();

>>>>>>> b099451 (revisi admin & super admin)
        return view('produk.edit', compact('produk', 'kategoris'));
    }

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

    public function destroy($id)
    {
        $produk = Produk::where('user_id', Auth::id())->findOrFail($id);

        if ($produk->gambar_logo) {
            Storage::disk('public')->delete($produk->gambar_logo);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function trash()
    {
        $produks = Produk::onlyTrashed()
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('produk.trash', compact('produks'));
    }

    public function restore($id)
    {
        $produk = Produk::onlyTrashed()
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $produk->restore();

        return redirect()->route('produk.trash')->with('success', 'Produk berhasil dipulihkan!');
    }

    public function forceDelete($id)
    {
        // Hapus semua sekaligus
        if ($id === 'all') {
            $produks = Produk::onlyTrashed()->where('user_id', Auth::id())->get();
            foreach ($produks as $produk) {
                if ($produk->gambar_logo) {
                    Storage::disk('public')->delete($produk->gambar_logo);
                }
                $produk->forceDelete();
            }
            return redirect()->route('produk.trash')->with('success', 'Semua produk berhasil dihapus permanen!');
        }

        // Hapus satu
        $produk = Produk::onlyTrashed()
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        if ($produk->gambar_logo) {
            Storage::disk('public')->delete($produk->gambar_logo);
        }

        $produk->forceDelete();

        return redirect()->route('produk.trash')->with('success', 'Produk berhasil dihapus permanen!');
    }
}