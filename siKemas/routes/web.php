<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DesainController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

// Route khusus Admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');

    // Manage User
    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
    Route::post('/user/{id}/approve', [App\Http\Controllers\Admin\UserController::class, 'approve'])->name('user.approve');
    Route::post('/user/{id}/reject', [App\Http\Controllers\Admin\UserController::class, 'reject'])->name('user.reject');
    Route::delete('/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/create-admin', [App\Http\Controllers\Admin\UserController::class, 'createAdmin'])->name('user.create-admin');
    Route::post('/user/store-admin', [App\Http\Controllers\Admin\UserController::class, 'storeAdmin'])->name('user.store-admin');
    Route::get('/kwt/{kwt}/user-list', [App\Http\Controllers\Admin\KwtController::class, 'userList'])->name('kwt.user-list');
    Route::get('/users/{user}/history', [UserController::class, 'history'])->name('user.history');

    // Manage KWT
    Route::get('/kwt', [App\Http\Controllers\Admin\KwtController::class, 'index'])->name('kwt.index');
    Route::get('/kwt/create', [App\Http\Controllers\Admin\KwtController::class, 'create'])->name('kwt.create');
    Route::post('/kwt', [App\Http\Controllers\Admin\KwtController::class, 'store'])->name('kwt.store');
    Route::get('/kwt/{id}/edit', [App\Http\Controllers\Admin\KwtController::class, 'edit'])->name('kwt.edit');
    Route::patch('/kwt/{id}', [App\Http\Controllers\Admin\KwtController::class, 'update'])->name('kwt.update');
    Route::delete('/kwt/{id}', [App\Http\Controllers\Admin\KwtController::class, 'destroy'])->name('kwt.destroy');

    // Manage Jenis Kemasan
    Route::get('/jenis-kemasan', [App\Http\Controllers\Admin\JenisKemasanController::class, 'index'])->name('jenis-kemasan.index');
    Route::get('/jenis-kemasan/create', [App\Http\Controllers\Admin\JenisKemasanController::class, 'create'])->name('jenis-kemasan.create');
    Route::post('/jenis-kemasan', [App\Http\Controllers\Admin\JenisKemasanController::class, 'store'])->name('jenis-kemasan.store');
    Route::get('/jenis-kemasan/{id}/edit', [App\Http\Controllers\Admin\JenisKemasanController::class, 'edit'])->name('jenis-kemasan.edit');
    Route::patch('/jenis-kemasan/{id}', [App\Http\Controllers\Admin\JenisKemasanController::class, 'update'])->name('jenis-kemasan.update');
    Route::delete('/jenis-kemasan/{id}', [App\Http\Controllers\Admin\JenisKemasanController::class, 'destroy'])->name('jenis-kemasan.destroy');

    // Manage Kategori
    Route::get('/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [App\Http\Controllers\Admin\KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('kategori.edit');
    Route::patch('/kategori/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('kategori.destroy');

});

// Route khusus User
Route::middleware(['auth', RoleMiddleware::class . ':user', 'approved'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('produk.index');
    })->name('dashboard');

    // Produk
    Route::resource('produk', ProdukController::class);
    Route::get('/produk/{id}/pilih-kemasan', [ProdukController::class, 'pilihKemasan'])->name('produk.pilih-kemasan');

    // Desain
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