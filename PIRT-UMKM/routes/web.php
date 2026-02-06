<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('auth.login');
});
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
Route::get('/produk', function () {
    return view('user.produk.produk');
});
Route::get('/profil', function () {
    return view('user.usaha.profil');
});
Route::get('/admin/dashboard', [AdminController::class,'index'] );
Route::get('/admin/usaha', function () {
    return view('admin.usaha');
});
Route::get('/admin/produk', function () {
    return view('admin.produk');
});