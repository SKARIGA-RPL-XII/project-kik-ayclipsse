<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});

Route::get('/login', [AuthController::class,'login'] );
Route::post('/login', [AuthController::class,'prosesLog'] )->name('proses.login');
Route::post('/logout', [AuthController::class,'logout'] )->name('logout');


Route::get('/profil', [UserController::class,'profil'] )->name('profil.usaha');
Route::put('/profil/{id}', [UserController::class,'profilUpdate'] )->name('profil.usaha.update');

Route::get('/produk', [UserController::class,'produk'] )->name('produk.usaha');
Route::put('/produk/{id}', [UserController::class,'produkUpdate'] )->name('produk.usaha.update');


Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/pendaftaran-usaha', function () {
    return view('user.usaha.pendaftaran');
});
Route::get('/pendaftaran-produk', function () {
    return view('user.produk.pendaftaran');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
});

Route::get('/admin/dashboard', [AdminController::class,'index'] );
Route::get('/admin/produk', [AdminController::class,'produk'] )->name('admin.produk');
Route::get('/admin/produk/{id}/modal', [AdminController::class,'produkModal'] )->name('admin.produk.modal');

Route::get('/admin/usaha', [AdminController::class,'usaha'] )->name('admin.usaha');
Route::get('/admin/persetujuan', function () {
    return view('admin.persetujuan');
});