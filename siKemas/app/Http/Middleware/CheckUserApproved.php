<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Admin skip pengecekan
            if ($user->hasRole('admin')) {
                return $next($request);
            }

            if ($user->status === 'pending') {
                Auth::logout();

                return redirect()
                    ->route('login')
                    ->with('error', 'Akun kamu belum disetujui admin. Mohon tunggu.');
            }

            if ($user->status === 'rejected') {
                Auth::logout();

                return redirect()
                    ->route('login')
                    ->with('error', 'Akun kamu ditolak oleh admin.');
            }
        }

        return $next($request);
    }
}