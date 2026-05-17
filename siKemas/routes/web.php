<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk user biasa
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route khusus Admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/manage-user', function () {
        return view('admin.manage-user');
    })->name('admin.manage-user');

});

// Route khusus User
Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {

    Route::get('/generate', function () {
        return view('generate');
    })->name('generate');

});

// Google Socialite
Route::get('/auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'callback'])->name('auth.google.callback');

// Complete Profile (khusus user Google yang belum lengkap)
Route::middleware(['auth'])->group(function () {
    Route::get('/complete-profile', [App\Http\Controllers\Auth\GoogleController::class, 'completeProfileForm'])->name('complete.profile');
    Route::post('/complete-profile', [App\Http\Controllers\Auth\GoogleController::class, 'completeProfile'])->name('complete.profile.store');
});

require __DIR__.'/auth.php';