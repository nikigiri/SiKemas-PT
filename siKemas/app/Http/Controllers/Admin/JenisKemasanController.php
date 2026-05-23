<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKemasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisKemasanController extends Controller
{
    public function index()
    {
        $jenisKemasans = JenisKemasan::all();
        return view('admin.jenis-kemasan.index', compact('jenisKemasans'));
    }

    public function create()
    {
        return view('admin.jenis-kemasan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kemasan'      => ['required', 'string', 'max:255'],
            'deskripsi_kemasan' => ['nullable', 'string'],
            'ikon_kemasan'      => ['nullable', 'image', 'max:2048'],
        ]);

        $ikonPath = null;
        if ($request->hasFile('ikon_kemasan')) {
            $ikonPath = $request->file('ikon_kemasan')->store('kemasan', 'public');
        }

        JenisKemasan::create([
            'nama_kemasan'      => $request->nama_kemasan,
            'deskripsi_kemasan' => $request->deskripsi_kemasan,
            'ikon_kemasan'      => $ikonPath ? 'storage/' . $ikonPath : null,
        ]);

        return redirect()->route('admin.jenis-kemasan.index')->with('success', 'Jenis kemasan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jenisKemasan = JenisKemasan::findOrFail($id);
        return view('admin.jenis-kemasan.edit', compact('jenisKemasan'));
    }

    public function update(Request $request, $id)
    {
        $jenisKemasan = JenisKemasan::findOrFail($id);

        $request->validate([
            'nama_kemasan'      => ['required', 'string', 'max:255'],
            'deskripsi_kemasan' => ['nullable', 'string'],
            'ikon_kemasan'      => ['nullable', 'image', 'max:2048'],
        ]);

        $ikonPath = $jenisKemasan->ikon_kemasan;
        if ($request->hasFile('ikon_kemasan')) {
            if ($ikonPath) {
                Storage::disk('public')->delete(str_replace('storage/', '', $ikonPath));
            }
            $ikonPath = 'storage/' . $request->file('ikon_kemasan')->store('kemasan', 'public');
        }

        $jenisKemasan->update([
            'nama_kemasan'      => $request->nama_kemasan,
            'deskripsi_kemasan' => $request->deskripsi_kemasan,
            'ikon_kemasan'      => $ikonPath,
        ]);

        return redirect()->route('admin.jenis-kemasan.index')->with('success', 'Jenis kemasan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $jenisKemasan = JenisKemasan::findOrFail($id);
        if ($jenisKemasan->ikon_kemasan) {
            Storage::disk('public')->delete(str_replace('storage/', '', $jenisKemasan->ikon_kemasan));
        }
        $jenisKemasan->delete();
        return redirect()->route('admin.jenis-kemasan.index')->with('success', 'Jenis kemasan berhasil dihapus!');
    }
}