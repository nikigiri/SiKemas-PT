<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kwt;
use App\Models\Produk;

class AdminController extends Controller
{
    // Dashboard Superadmin
    public function dashboard()
    {
        $totalUser    = User::role('user')->count();
        $totalPending = User::role('user')->where('status', 'pending')->count();
        $totalKwt     = Kwt::count();
        $totalProduk  = Produk::count();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalPending',
            'totalKwt',
            'totalProduk'
        ));
    }

    // Dashboard Admin per KWT
    public function kwtDashboard()
    {
        $kwt          = auth()->user()->kwt;
        $totalUser    = User::role('user')->where('kwt_id', auth()->user()->kwt_id)->count();
        $totalPending = User::role('user')->where('kwt_id', auth()->user()->kwt_id)->where('status', 'pending')->count();

        return view('admin.kwt-dashboard', compact('kwt', 'totalUser', 'totalPending'));
    }
}