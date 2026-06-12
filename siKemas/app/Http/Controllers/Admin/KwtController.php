<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kwt;
use Illuminate\Http\Request;

class KwtController extends Controller
{
    public function index()
    {
        $kwts = Kwt::withCount('users')->get();
        return view('admin.kwt.index', compact('kwts'));
    }

    public function create()
    {
        return view('admin.kwt.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kwt'   => ['required', 'string', 'max:255'],
            'no_kwt'     => ['nullable', 'string', 'max:50'],
            'alamat_kwt' => ['nullable', 'string'],
            'desa'       => ['nullable', 'string', 'max:255'],
        ]);

        Kwt::create($request->only(['nama_kwt', 'no_kwt', 'alamat_kwt', 'desa']));

        return redirect()->route('admin.kwt.index')->with('success', 'KWT berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kwt = Kwt::findOrFail($id);
        return view('admin.kwt.edit', compact('kwt'));
    }

    public function editSelf()
    {
        $kwt = auth()->user()->kwt;

        if (!$kwt) {
            return redirect()->route('kwt-admin.dashboard')->with('error', 'KWT tidak ditemukan.');
        }

        return view('admin.kwt.edit-self', compact('kwt'));
    }

    public function updateSelf(Request $request)
    {
        $kwt = auth()->user()->kwt;

        $request->validate([
            'nama_kwt'   => 'required|string|max:255',
            'no_kwt'     => 'nullable|string|max:100',
            'desa'       => 'nullable|string|max:255',
            'alamat_kwt' => 'nullable|string|max:500',
        ]);

        $kwt->update($request->only(['nama_kwt', 'no_kwt', 'desa', 'alamat_kwt']));

        return redirect()->route('kwt-admin.dashboard')->with('success', 'Info KWT berhasil diperbarui!');
    }

    public function update(Request $request, $id)
    {
        $kwt = Kwt::findOrFail($id);

        $request->validate([
            'nama_kwt'   => ['required', 'string', 'max:255'],
            'no_kwt'     => ['nullable', 'string', 'max:50'],
            'alamat_kwt' => ['nullable', 'string'],
            'desa'       => ['nullable', 'string', 'max:255'],
        ]);

        $kwt->update($request->only(['nama_kwt', 'no_kwt', 'alamat_kwt', 'desa']));

        return redirect()->route('admin.kwt.index')->with('success', 'KWT berhasil diupdate!');
    }

    public function userList(Kwt $kwt)
    {
        $users = $kwt->users()->with('kwt')->orderBy('created_at', 'desc')->get();
        return view('admin.kwt.user-list', compact('kwt', 'users'));
    }

    public function destroy($id)
    {
        $kwt = Kwt::findOrFail($id);
        $kwt->delete();
        return redirect()->route('admin.kwt.index')->with('success', 'KWT berhasil dihapus!');
    }
}