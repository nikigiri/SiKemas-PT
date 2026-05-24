<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DesainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KwtController;
use App\Http\Controllers\Admin\JenisKemasanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::post('/generate-ai', function (Request $request) {
    $request->validate([
        'prompt' => 'required|string',
        'jenis_kemasan_id' => 'required',
        'palet_warna_id' => 'required'
    ]);

    $kemasan = "Box Karton"; 
    $warna = "Earth Tone (Coklat, Hijau)";
    $userPrompt = $request->input('prompt');

    $fullPrompt = "Sebagai ahli desain kemasan (UI/UX dan Branding), berikan 3 konsep ide desain kemasan dengan detail berikut:\n"
                . "- Jenis Wadah: {$kemasan}\n"
                . "- Palet Warna: {$warna}\n"
                . "- Instruksi Spesifik: {$userPrompt}\n\n"
                . "Jelaskan dengan format poin-poin yang singkat dan menarik.";

    $apiKey = env('GEMINI_API_KEY');
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}";

    $response = Http::post($url, [
        'contents' => [
            [
                'parts' => [
                    ['text' => $fullPrompt]
                ]
            ]
        ]
    ]);

    if ($response->successful()) {
        $resultText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
        
        return response()->json([
            'success' => true, 
            'data' => $resultText
        ]);
    }

    return response()->json([
        'success' => false, 
        'message' => 'Gagal memuat ide desain dari AI. Pastikan API Key valid dan server terhubung ke internet.'
    ], 500);
});

Route::get('/', function () {
    return view('welcome');
});

//admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // ── User Management ──────────────────────────────────────────
        // Static routes harus di atas route berparameter
        Route::get('/user',               [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create-admin',  [UserController::class, 'createAdmin'])->name('user.create-admin');
        Route::post('/user/store-admin',  [UserController::class, 'storeAdmin'])->name('user.store-admin');

        // Routes berparameter
        Route::get('/user/{user}/history',  [UserController::class, 'history'])->name('user.history');
        Route::post('/user/{id}/approve',   [UserController::class, 'approve'])->name('user.approve');
        Route::post('/user/{id}/reject',    [UserController::class, 'reject'])->name('user.reject');
        Route::delete('/user/{id}',         [UserController::class, 'destroy'])->name('user.destroy');

        // ── KWT Management ───────────────────────────────────────────
        Route::get('/kwt/{kwt}/user-list',  [KwtController::class, 'userList'])->name('kwt.user-list');
        Route::get('/kwt/create',           [KwtController::class, 'create'])->name('kwt.create');
        Route::get('/kwt',                  [KwtController::class, 'index'])->name('kwt.index');
        Route::post('/kwt',                 [KwtController::class, 'store'])->name('kwt.store');
        Route::get('/kwt/{id}/edit',        [KwtController::class, 'edit'])->name('kwt.edit');
        Route::patch('/kwt/{id}',           [KwtController::class, 'update'])->name('kwt.update');
        Route::delete('/kwt/{id}',          [KwtController::class, 'destroy'])->name('kwt.destroy');

        // ── Jenis Kemasan Management ──────────────────────────────────
        Route::get('/jenis-kemasan/create',  [JenisKemasanController::class, 'create'])->name('jenis-kemasan.create');
        Route::get('/jenis-kemasan',         [JenisKemasanController::class, 'index'])->name('jenis-kemasan.index');
        Route::post('/jenis-kemasan',        [JenisKemasanController::class, 'store'])->name('jenis-kemasan.store');
        Route::get('/jenis-kemasan/{id}/edit',  [JenisKemasanController::class, 'edit'])->name('jenis-kemasan.edit');
        Route::patch('/jenis-kemasan/{id}',     [JenisKemasanController::class, 'update'])->name('jenis-kemasan.update');
        Route::delete('/jenis-kemasan/{id}',    [JenisKemasanController::class, 'destroy'])->name('jenis-kemasan.destroy');

        // ── Kategori Management ───────────────────────────────────────
        Route::get('/kategori/create',  [KategoriController::class, 'create'])->name('kategori.create');
        Route::get('/kategori',         [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/kategori',        [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{id}/edit',   [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::patch('/kategori/{id}',      [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}',     [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });


//user
Route::middleware(['auth', RoleMiddleware::class . ':user', 'approved'])
    ->group(function () {

        Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

        // Produk
        Route::resource('produk', ProdukController::class);
        Route::get('/produk/{id}/pilih-kemasan', [ProdukController::class, 'pilihKemasan'])->name('produk.pilih-kemasan');

        // Desain
        Route::resource('desain', DesainController::class)->only(['index', 'store', 'show', 'destroy']);
    });

//profile
Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Complete Profile (Google user yang belum lengkap)
    Route::get('/complete-profile',  [GoogleController::class, 'completeProfileForm'])->name('complete.profile');
    Route::post('/complete-profile', [GoogleController::class, 'completeProfile'])->name('complete.profile.store');
});

//socialite googl
Route::get('/auth/google',          [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'storeStep1'])
        ->name('register.store');

    Route::get('/register/business', [RegisteredUserController::class, 'createBusiness'])
        ->name('register.business');

    Route::post('/register/business', [RegisteredUserController::class, 'storeBusiness'])
        ->name('register.business.store');
});

require __DIR__ . '/auth.php';