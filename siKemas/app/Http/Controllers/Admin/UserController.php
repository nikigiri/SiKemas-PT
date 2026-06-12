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

    // List user hanya di KWT admin yang login
    public function kwtIndex()
    {
        $kwtId = auth()->user()->kwt_id;
        $users = User::role('user')->where('kwt_id', $kwtId)->with('kwt')->orderBy('created_at', 'desc')->get();
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

    public function createAdmin()
    {
        $kwts = Kwt::all();
        return view('admin.user.create-admin', compact('kwts'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_tlp'        => ['required', 'string', 'max:20'],
            'alamat_usaha'  => ['required', 'string'],
            'kwt_id'        => ['required', 'exists:kwts,id'],
            'password'      => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name'         => $request->name,
            'nama_usaha'   => '-',
            'no_tlp'       => $request->no_tlp,
            'alamat_usaha' => $request->alamat_usaha,
            'kwt_id'       => $request->kwt_id,
            'status'       => 'approved',
            'password'     => bcrypt($request->password),
            'email'        => $request->email,
        ]);

        $user->assignRole('admin');

        return redirect()->route('admin.kwt.user-list', $user->kwt_id)->with('success', 'Admin baru berhasil ditambahkan!');
    }

    //history
    public function history(User $user)
    {
        // Ambil semua produk milik user beserta desainnya
        $produks = $user->produks()->with([
            'desains.jenisKemasan',
            'desains.hasilEkspors',
        ])->latest()->get();

        // Bangun timeline history dari produk & desain
        $histories = collect();

        foreach ($produks as $produk) {
            // Catat aktivitas buat produk
            $histories->push([
                'type'        => 'produk',
                'action'      => 'Membuat Produk',
                'title'       => $produk->nama_produk,
                'description' => $produk->tagline ?? '-',
                'date'        => $produk->created_at,
                'icon'        => 'produk',
            ]);

            foreach ($produk->desains as $desain) {
                // Catat aktivitas buat desain
                $histories->push([
                    'type'        => 'desain',
                    'action'      => 'Membuat Desain',
                    'title'       => $desain->judul_desain,
                    'description' => $desain->jenisKemasan->nama_kemasan ?? '-',
                    'status'      => $desain->status_desain,
                    'date'        => $desain->created_at,
                    'icon'        => 'desain',
                ]);

                // Catat aktivitas ekspor kalau ada
                foreach ($desain->hasilEkspors as $ekspor) {
                    $histories->push([
                        'type'        => 'ekspor',
                        'action'      => 'Mengekspor Desain',
                        'title'       => $desain->judul_desain,
                        'description' => 'File diekspor',
                        'date'        => $ekspor->created_at,
                        'icon'        => 'ekspor',
                    ]);
                }
            }
        }

        // Urutkan semua aktivitas dari yang terbaru
        $histories = $histories->sortByDesc('date')->values();

        return view('admin.user.history', compact('user', 'histories'));
    }

    public function produk(\App\Models\User $user)
    {
        $produks = \App\Models\Produk::where('user_id', $user->id)
            ->with('desains')
            ->latest()
            ->get();

        return view('admin.user.produk', compact('user', 'produks'));
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}