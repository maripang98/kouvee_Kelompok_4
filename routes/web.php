<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ProdukController,
    LayananController,
    PegawaiController,
    HewanController,
    CustomerController,
    DashboardOwnerController,
    DashboardCsController
};

/*
|--------------------------------------------------------------------------
| 🌐 ROUTE PUBLIK
|--------------------------------------------------------------------------
*/

// 🏠 Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// ℹ️ Halaman tentang
Route::view('/about', 'about')->name('about');

// 🛍️ Katalog publik (harus didefinisikan sebelum resource)
Route::get('/katalog-produk', [ProdukController::class, 'katalog'])->name('produk.katalog');
Route::get('/katalog-layanan', [LayananController::class, 'katalog'])->name('layanan.katalog');


/*
|--------------------------------------------------------------------------
| ⚙️ CRUD ADMIN GLOBAL
|--------------------------------------------------------------------------
*/
Route::resources([
    'produk' => ProdukController::class,
    'layanan' => LayananController::class,
    'pegawai' => PegawaiController::class,
    'customer' => CustomerController::class,
    'hewan' => HewanController::class,
]);


/*
|--------------------------------------------------------------------------
| 🧭 DASHBOARD OWNER
|--------------------------------------------------------------------------
*/
Route::prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [DashboardOwnerController::class, 'index'])->name('dashboard');

    Route::resources([
        'produk' => ProdukController::class,
        'pegawai' => PegawaiController::class,
        'layanan' => LayananController::class,
    ]);
});


/*
|--------------------------------------------------------------------------
| 💼 DASHBOARD CUSTOMER SERVICE (CS)
|--------------------------------------------------------------------------
*/
Route::prefix('cs')->name('cs.')->group(function () {
    Route::get('/dashboard', [DashboardCsController::class, 'index'])->name('dashboard');

    Route::resources([
        'customer' => CustomerController::class,
        'hewan' => HewanController::class,
    ]);
});
