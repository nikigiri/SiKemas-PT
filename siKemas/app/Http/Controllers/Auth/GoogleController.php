<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Redirect ke halaman login Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle callback dari Google
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
    return redirect()->route('login')->with('error', $e->getMessage());
}

        $user = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'name'          => $googleUser->name,
                'nama_usaha'    => null,
                'no_tlp'        => null,
                'alamat_usaha'  => null,
                'password'      => bcrypt(Str::random(16)),
            ]
        );

        // Auto assign role user kalau belum punya role
        if ($user->roles->isEmpty()) {
            $user->assignRole('user');
        }

        Auth::login($user);

        // Cek apakah profile sudah lengkap
        if (empty($user->nama_usaha) || empty($user->no_tlp) || empty($user->alamat_usaha)) {
            return redirect()->route('complete.profile');
        }

        // Redirect berdasarkan role
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    // Tampilkan form complete profile
    public function completeProfileForm()
    {
        return view('auth.complete-profile');
    }

    // Simpan data complete profile
    public function completeProfile(Request $request)
    {
        $request->validate([
            'nama_usaha'   => ['required', 'string', 'max:255'],
            'no_tlp'       => ['required', 'string', 'max:20'],
            'alamat_usaha' => ['required', 'string'],
        ]);

        $user = Auth::user();
        $user->update([
            'nama_usaha'   => $request->nama_usaha,
            'no_tlp'       => $request->no_tlp,
            'alamat_usaha' => $request->alamat_usaha,
        ]);

        return redirect()->route('dashboard');
    }
}