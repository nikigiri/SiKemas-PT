<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kwt;
use App\Models\Produk;

class AdminController extends Controller
{
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
}