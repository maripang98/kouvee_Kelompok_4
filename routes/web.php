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
    DashboardCsController,
    CSTransaksiProdukController,
    CSTransaksiLayananController,
    KasirController,
    AuthController
};

/*
|--------------------------------------------------------------------------
| 🌐 PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');

Route::get('/katalog-produk', [ProdukController::class, 'katalog'])->name('produk.katalog');
Route::get('/katalog-layanan', [LayananController::class, 'katalog'])->name('layanan.katalog');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/layanan/{id}', [LayananController::class, 'show'])->name('layanan.show');

/*
|--------------------------------------------------------------------------
| 🔐 AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| 🔒 HARUS LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | 👑 OWNER (ID_JABATAN = 1)
    |--------------------------------------------------------------------------
    */
    Route::prefix('owner')
        ->name('owner.')
        ->middleware('role:owner')
        ->group(function () {

            Route::get('/dashboard', [DashboardOwnerController::class, 'index'])
                ->name('dashboard');

            Route::resource('produk', ProdukController::class);
            Route::resource('layanan', LayananController::class);
            Route::resource('pegawai', PegawaiController::class);

            Route::get('/laporan', fn () => view('owner.laporan.index'))
                ->name('laporan.index');

            Route::get('/laporan/layanan-terlaris',
                [DashboardOwnerController::class, 'laporanLayanan']
            )->name('laporan.layanan');

            Route::get('/laporan/layanan-terlaris/pdf',
                [DashboardOwnerController::class, 'laporanLayananPdf']
            )->name('laporan.layanan.pdf');

            Route::get('/laporan/produk-terlaris',
                [DashboardOwnerController::class, 'laporanProduk']
            )->name('laporan.produk');

            Route::get('/laporan/produk-terlaris/pdf',
                [DashboardOwnerController::class, 'laporanProdukPdf']
            )->name('laporan.produk.pdf');

            Route::get('/laporan/pendapatan-bulanan',
                [DashboardOwnerController::class, 'pendapatanBulanan']
            )->name('laporan.pendapatan.bulanan');

            Route::get('/laporan/pendapatan-bulanan/pdf',
                [DashboardOwnerController::class, 'pendapatanBulananPdf']
            )->name('laporan.pendapatan_bulanan_pdf');

            Route::get('/laporan/pendapatan-tahunan',
                [DashboardOwnerController::class, 'pendapatanTahunan']
            )->name('laporan.pendapatan.tahunan');

            Route::get('/laporan/pendapatan-tahunan/pdf',
                [DashboardOwnerController::class, 'pendapatanTahunanPdf']
            )->name('laporan.pendapatan.tahunan.pdf');
        });

    /*
    |--------------------------------------------------------------------------
    | 💼 CS (ID_JABATAN = 2)
    |--------------------------------------------------------------------------
    */
    Route::prefix('cs')
        ->name('cs.')
        ->middleware('role:cs')
        ->group(function () {

            Route::get('/dashboard', [DashboardCsController::class, 'index'])
                ->name('dashboard');

            Route::resource('customer', CustomerController::class);
            Route::resource('hewan', HewanController::class);
            Route::resource('transaksi_produk', CSTransaksiProdukController::class);
            Route::resource('transaksi_layanan', CSTransaksiLayananController::class);

            Route::put('/layanan/{id}/ketersediaan',
                [CSTransaksiLayananController::class, 'updateKetersediaan']
            )->name('layanan.updateKetersediaan');
        });

    /*
    |--------------------------------------------------------------------------
    | 💰 KASIR (ID_JABATAN = 3)
    |--------------------------------------------------------------------------
    */
    Route::prefix('kasir')
        ->name('kasir.')
        ->middleware('role:kasir')
        ->group(function () {

            Route::get('/dashboard', [KasirController::class, 'dashboard'])
                ->name('dashboard');

            Route::get('/transaksi-produk', [KasirController::class, 'produk'])
                ->name('produk');

            Route::get('/transaksi-layanan', [KasirController::class, 'layanan'])
                ->name('layanan');

            Route::post('/bayar/{jenis}/{id}', [KasirController::class, 'bayar'])
                ->name('bayar');

            Route::get('/nota/produk/{id}', [KasirController::class, 'notaProduk'])
                ->name('nota.produk');

            Route::get('/nota/layanan/{id}', [KasirController::class, 'notaLayanan'])
                ->name('nota.layanan');
        });
});
