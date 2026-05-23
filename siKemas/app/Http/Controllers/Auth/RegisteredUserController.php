<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kwt;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $kwts = Kwt::all();
        return view('auth.register', compact('kwts'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'nama_usaha'    => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'no_tlp'        => ['required', 'string', 'max:20'],
            'alamat_usaha'  => ['required', 'string'],
            'kwt_id'        => ['required', 'exists:kwts,id'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'          => $request->name,
            'nama_usaha'    => $request->nama_usaha,
            'email'         => $request->email,
            'no_tlp'        => $request->no_tlp,
            'alamat_usaha'  => $request->alamat_usaha,
            'kwt_id'        => $request->kwt_id,
            'status'        => 'pending',
            'password'      => Hash::make($request->password),
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Registrasi berhasil! Akun kamu sedang menunggu persetujuan admin.');
    }
}