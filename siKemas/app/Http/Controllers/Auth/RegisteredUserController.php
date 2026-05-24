<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kwt;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    
    public function create(): View
    {
        return view('auth.register');
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'no_tlp'   => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // simpan sementara
        session([
            'register_data' => $validated
        ]);

        return redirect()->route('register.business');
    }

    public function createBusiness()
    {
        if (!session()->has('register_data')) {
            return redirect()->route('register');
        }

        $kwts = Kwt::all();

        return view('auth.daftar-usaha', compact('kwts'));
    }

    public function storeBusiness(Request $request)
    {
        $request->validate([
            'nama_usaha'   => ['required', 'string', 'max:255'],
            'alamat_usaha' => ['required', 'string'],
            'kwt_id'       => ['required', 'exists:kwts,id'],
        ]);

        $registerData = session('register_data');

        // CREATE USER
        $user = User::create([
            'name'          => $registerData['name'],
            'email'         => $registerData['email'],
            'no_tlp'        => $registerData['no_tlp'],
            'password'      => Hash::make($registerData['password']),

            'nama_usaha'    => $request->nama_usaha,
            'alamat_usaha'  => $request->alamat_usaha,
            'kwt_id'        => $request->kwt_id,

            'status'        => 'pending',
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        // hapus session
        session()->forget('register_data');

        return redirect()
            ->route('login')
            ->with('status', 'Registrasi berhasil! Akun kamu sedang menunggu persetujuan admin.');
    }
}