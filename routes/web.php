<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LayananController;

// Halaman Home
Route::get('/', function () {
    return view('home');
});

// Halaman Profil / About
Route::get('/about', function () {
    return view('about');
});


Route::resource('customer', CustomerController::class);

// 🧼 CRUD Layanan
Route::resource('layanan', LayananController::class);