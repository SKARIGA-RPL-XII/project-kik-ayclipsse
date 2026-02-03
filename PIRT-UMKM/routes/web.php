<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/home', function () {
    return view('home');
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
Route::get('/admin/usaha', function () {
    return view('admin.usaha');
});
Route::get('/admin/produk', function () {
    return view('admin.produk');
});