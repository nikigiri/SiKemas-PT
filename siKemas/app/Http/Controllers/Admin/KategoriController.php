<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{

    // SUPERADMIN


    public function index()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'deskripsi'     => ['nullable', 'string'],
        ]);

        Kategori::create($request->only(['nama_kategori', 'deskripsi']));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'deskripsi'     => ['nullable', 'string'],
        ]);

        $kategori->update($request->only(['nama_kategori', 'deskripsi']));

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }


    // KWT ADMIN


    public function kwtIndex()
    {
        $kategoris = Kategori::where('kwt_id', Auth::user()->kwt_id)->orderBy('nama_kategori')->get();
        return view('kwt-admin.kategori.index', compact('kategoris'));
    }

    public function kwtCreate()
    {
        return view('kwt-admin.kategori.create');
    }

    public function kwtStore(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'deskripsi'     => ['nullable', 'string'],
        ]);

        Kategori::create([
            'kwt_id'        => Auth::user()->kwt_id,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('kwt-admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function kwtEdit($id)
    {
        $kategori = Kategori::where('kwt_id', Auth::user()->kwt_id)->findOrFail($id);
        return view('kwt-admin.kategori.edit', compact('kategori'));
    }

    public function kwtUpdate(Request $request, $id)
    {
        $kategori = Kategori::where('kwt_id', Auth::user()->kwt_id)->findOrFail($id);

        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'deskripsi'     => ['nullable', 'string'],
        ]);

        $kategori->update([
            'kwt_id'        => Auth::user()->kwt_id,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('kwt-admin.kategori.index')->with('success', 'Kategori berhasil diupdate!');
    }

    public function kwtDestroy($id)
    {
        $kategori = Kategori::where('kwt_id', Auth::user()->kwt_id)->findOrFail($id);
        $kategori->delete();
        return redirect()->route('kwt-admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}