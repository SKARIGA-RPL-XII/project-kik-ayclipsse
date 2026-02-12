<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginStore'])->name('proses.login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/produk', [AdminController::class, 'produk'])->name('admin.produk');
        Route::get('/admin/produk/{id}/modal', [AdminController::class, 'produkModal'])->name('admin.produk.modal');
        Route::delete('/admin/produk/{id}', [AdminController::class, 'produkDestroy']);

        Route::get('/admin/usaha', [AdminController::class, 'usaha'])->name('admin.usaha');
        Route::get('/admin/usaha/{id}', [AdminController::class, 'usahaDestroy'])->name('admin.usaha.destroy');
    });
    Route::middleware('role:user')->group(function () {
        Route::get('/profil', [UserController::class, 'profil'])->name('profil.usaha');
        Route::put('/profil/{id}', [UserController::class, 'profilUpdate'])->name('profil.usaha.update');

        Route::get('/pendaftaran-usaha', [UserController::class, 'usaha'])->name('usaha.pendaftaran');
        Route::post('/pendaftaran-usaha', [UserController::class, 'usahaStore'])->name('usaha.pendaftaran.store');
        Route::get('/produk', [UserController::class, 'produk'])->name('produk.usaha');
        Route::put('/produk/{id}', [UserController::class, 'produkUpdate'])->name('produk.usaha.update');
        Route::delete('/produk/{id}', [UserController::class, 'produkDestroy'])->name('produk.usaha.destroy');
        Route::get('/pendaftaran-produk', [UserController::class, 'pendaftaranProduk'])->name('user.produk.pendaftaran');
        Route::post('/pendaftaran-produk', [UserController::class, 'pendaftaranProdukStore'])->name('produk.usaha.pendaftaran.store');
    });
});


// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// });
// Route::get('/dashboardkosong', function () {
//     return view('user.dashboardkosong');
// });


Route::get('/admin/persetujuan', function () {
    return view('admin.persetujuan');
});
