<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kwt;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // List semua user
    public function index()
    {
        $users = User::role('user')->with('kwt')->orderBy('created_at', 'desc')->get();
        return view('admin.user.index', compact('users'));
    }

    // Approve user
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'User berhasil diapprove!');
    }

    // Reject user
    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'User berhasil ditolak!');
    }

    // Tambah admin baru
    public function createAdmin()
    {
        return view('admin.user.create-admin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::create([
            'name'          => $request->name,
            'nama_usaha'    => '-',
            'no_tlp'        => '-',
            'alamat_usaha'  => '-',
            'status'        => 'approved',
            'password'      => bcrypt($request->password),
            'email'         => $request->email,
        ]);

        $user->assignRole('admin');

        return redirect()->route('admin.user.index')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}