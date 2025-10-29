<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Layanan;
use App\Models\Pegawai;


class DashboardOwnerController extends Controller
{
    public function index()
    {
        // Ambil total dari setiap tabel
        $totalProduk = Produk::count();
        $totalLayanan = Layanan::count();
        $totalPegawai = Pegawai::count();

        // Ambil data terbaru untuk tabel preview
        $produk = Produk::latest('ID_PRODUK')->take(5)->get();
        $layanan = Layanan::latest('ID_LAYANAN')->take(5)->get();
        $pegawai = Pegawai::latest('ID_PEGAWAI')->take(5)->get();

        return view('owner.dashboard', compact(
            'totalProduk',
            'totalLayanan',
            'totalPegawai',
            'produk',
            'layanan',
            'pegawai'
        ));
    }
}
