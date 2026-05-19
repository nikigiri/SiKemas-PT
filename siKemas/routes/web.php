<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DesainController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
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

    Route::get('/dashboard', function () {
        return redirect()->route('produk.index');
    })->name('dashboard');

    // Produk
    Route::resource('produk', ProdukController::class);
    Route::get('/produk/{id}/pilih-kemasan', [ProdukController::class, 'pilihKemasan'])->name('produk.pilih-kemasan');

    //Desain
    Route::resource('desain', DesainController::class)->only(['index', 'store', 'show', 'destroy']);

});

// Route auth (admin & user)
Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Complete Profile (khusus user Google yang belum lengkap)
    Route::get('/complete-profile', [App\Http\Controllers\Auth\GoogleController::class, 'completeProfileForm'])->name('complete.profile');
    Route::post('/complete-profile', [App\Http\Controllers\Auth\GoogleController::class, 'completeProfile'])->name('complete.profile.store');

});

// Google Socialite
Route::get('/auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'callback'])->name('auth.google.callback');

require __DIR__.'/auth.php';