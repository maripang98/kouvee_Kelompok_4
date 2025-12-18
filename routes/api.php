<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\HewanApiController;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\AuthApiController;

// TEST
Route::get('/test', fn() => ['message' => 'API OK']);
Route::get('/produk', [ProdukApiController::class, 'apiIndex']);
// Route::post('/produk', [ProdukApiController::class, 'store']);
// Route::put('/produk/{id}', [ProdukApiController::class, 'update']);
// Route::delete('/produk/{id}', [ProdukApiController::class, 'destroy']);

Route::get('/layanan', [LayananController::class, 'apiIndex']);

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout']);

// CUSTOMER API
Route::get('/customer', [CustomerApiController::class, 'apiIndex']);
Route::post('/customer', [CustomerApiController::class, 'apiStore']);
Route::put('/customer/{id}', [CustomerApiController::class, 'apiUpdate']);
Route::delete('/customer/{id}', [CustomerApiController::class, 'apiDelete']);

// HEWAN API
Route::get('/hewan', [HewanApiController::class, 'apiIndex']);
Route::post('/hewan', [HewanApiController::class, 'apiStore']);
Route::put('/hewan/{id}', [HewanApiController::class, 'apiUpdate']);
Route::delete('/hewan/{id}', [HewanApiController::class, 'apiDelete']);


