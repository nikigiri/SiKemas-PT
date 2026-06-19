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
use App\Models\Produk;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// SUPER ADMIN ROUTES
Route::middleware(['auth', RoleMiddleware::class . ':superadmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Manage User (semua KWT)
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create-admin', [UserController::class, 'createAdmin'])->name('user.create-admin');
        Route::post('/user/store-admin', [UserController::class, 'storeAdmin'])->name('user.store-admin');
        Route::get('/user/{user}/history', [UserController::class, 'history'])->name('user.history');
        Route::get('/user/{user}/produk', [UserController::class, 'produk'])->name('user.produk');
        Route::post('/user/{id}/approve', [UserController::class, 'approve'])->name('user.approve');
        Route::post('/user/{id}/reject', [UserController::class, 'reject'])->name('user.reject');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        // Manage KWT
        Route::get('/kwt/{kwt}/user-list', [KwtController::class, 'userList'])->name('kwt.user-list');
        Route::get('/kwt/create', [KwtController::class, 'create'])->name('kwt.create');
        Route::get('/kwt', [KwtController::class, 'index'])->name('kwt.index');
        Route::post('/kwt', [KwtController::class, 'store'])->name('kwt.store');
        Route::get('/kwt/{id}/edit', [KwtController::class, 'edit'])->name('kwt.edit');
        Route::patch('/kwt/{id}', [KwtController::class, 'update'])->name('kwt.update');
        Route::delete('/kwt/{id}', [KwtController::class, 'destroy'])->name('kwt.destroy');

        // Manage Jenis Kemasan (global)
        Route::get('/jenis-kemasan/create', [JenisKemasanController::class, 'create'])->name('jenis-kemasan.create');
        Route::get('/jenis-kemasan', [JenisKemasanController::class, 'index'])->name('jenis-kemasan.index');
        Route::post('/jenis-kemasan', [JenisKemasanController::class, 'store'])->name('jenis-kemasan.store');
        Route::get('/jenis-kemasan/{id}/edit', [JenisKemasanController::class, 'edit'])->name('jenis-kemasan.edit');
        Route::patch('/jenis-kemasan/{id}', [JenisKemasanController::class, 'update'])->name('jenis-kemasan.update');
        Route::delete('/jenis-kemasan/{id}', [JenisKemasanController::class, 'destroy'])->name('jenis-kemasan.destroy');

        // Manage Kategori (global)
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::patch('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

// ADMIN PER KWT ROUTES
Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('kwt-admin')
    ->name('kwt-admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'kwtDashboard'])->name('dashboard');

        // Manage User (hanya KWT-nya sendiri)
        Route::get('/user', [UserController::class, 'kwtIndex'])->name('user.index');
        Route::post('/user/{id}/approve', [UserController::class, 'approve'])->name('user.approve');
        Route::post('/user/{id}/reject', [UserController::class, 'reject'])->name('user.reject');
        Route::get('/user/{user}/history', [UserController::class, 'history'])->name('user.history');
        Route::get('/user/{user}/produk', [UserController::class, 'produk'])->name('user.produk');

        Route::get('/kwt/edit', [KwtController::class, 'editSelf'])->name('kwt.edit.self');
        Route::patch('/kwt/update', [KwtController::class, 'updateSelf'])->name('kwt.update.self');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        // Manage Jenis Kemasan (per KWT)
        Route::get('/jenis-kemasan', [JenisKemasanController::class, 'kwtIndex'])->name('jenis-kemasan.index');
        Route::get('/jenis-kemasan/create', [JenisKemasanController::class, 'kwtCreate'])->name('jenis-kemasan.create');
        Route::post('/jenis-kemasan', [JenisKemasanController::class, 'kwtStore'])->name('jenis-kemasan.store');
        Route::get('/jenis-kemasan/{id}/edit', [JenisKemasanController::class, 'kwtEdit'])->name('jenis-kemasan.edit');
        Route::patch('/jenis-kemasan/{id}', [JenisKemasanController::class, 'kwtUpdate'])->name('jenis-kemasan.update');
        Route::delete('/jenis-kemasan/{id}', [JenisKemasanController::class, 'kwtDestroy'])->name('jenis-kemasan.destroy');

        // Manage Kategori (per KWT)
        Route::get('/kategori', [KategoriController::class, 'kwtIndex'])->name('kategori.index');
        Route::get('/kategori/create', [KategoriController::class, 'kwtCreate'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'kwtStore'])->name('kategori.store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'kwtEdit'])->name('kategori.edit');
        Route::patch('/kategori/{id}', [KategoriController::class, 'kwtUpdate'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'kwtDestroy'])->name('kategori.destroy');
    });


// USER ROUTES
Route::middleware(['auth', RoleMiddleware::class . ':user', 'approved'])
    ->group(function () {
        Route::get('/dashboard', function () {
            $produks = Produk::where('user_id', auth()->id())
                ->with('desains')
                ->latest()
                ->take(6)
                ->get();
            return view('dashboard', compact('produks'));
        })->name('dashboard');

        Route::resource('produk', ProdukController::class);

        Route::get('/produk/{id}/pilih-kemasan',
            [ProdukController::class, 'pilihKemasan']
        )->name('produk.pilih-kemasan');

        Route::resource('desain', DesainController::class)
            ->only(['index', 'store', 'show', 'destroy']);

        Route::get('/desain/{id}/export', [DesainController::class, 'exportPdf'])->name('desain.export');
        
    });


// SHARED AUTH ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/complete-profile', [GoogleController::class, 'completeProfileForm'])->name('complete.profile');
    Route::post('/complete-profile', [GoogleController::class, 'completeProfile'])->name('complete.profile.store');
});


// GOOGLE SOCIALITE
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'storeStep1'])->name('register.store');
    Route::get('/register/business', [RegisteredUserController::class, 'createBusiness'])->name('register.business');
    Route::post('/register/business', [RegisteredUserController::class, 'storeBusiness'])->name('register.business.store');
});

Route::middleware(['auth'])->post('/generate-desain', function (Request $request) {

    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'jenis_kemasan' => 'required|string|max:255',
        'warna_kemasan' => 'required|string|max:255',
        'prompt_tambahan' => 'nullable|string',
    ]);

    $prompt = "
    Anggap kamu sebagai desainer kemasan profesional.

    Nama Produk: {$request->nama_produk}
    Jenis Kemasan: {$request->jenis_kemasan}
    Warna Kemasan: {$request->warna_kemasan}

    Instruksi Tambahan:
    {$request->prompt_tambahan}

    Buatkan konsep desain kemasan yang detail dan profesional.
    ";

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . config('services.openai.api_key'),
        'Content-Type' => 'application/json',
    ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => config('services.openai.model'),
        'messages' => [
            ['role' => 'user', 'content' => $prompt]
        ],
    ]);

    return response()->json([
        'status' => true,
        'hasil' => $response->json('choices.0.message.content')
    ]);
});

Route::get('/cek-key', function () {
    abort_unless(app()->isLocal(), 403);
    dd(config('services.openai.api_key'));
});
    
require __DIR__ . '/auth.php';