<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;
use App\Models\Customer;
use App\Models\Produk;    
use App\Models\Layanan;   

class DashboardCsController extends Controller
{
     public function index()
    {
        // Hitung total
        $totalCustomer = Customer::count();
        $totalHewan = Hewan::count();

        // Ambil data terbaru
        $customers = Customer::latest('ID_CUSTOMER')->take(5)->get();
        $hewans = Hewan::with('customer')->latest('ID_HEWAN')->take(5)->get();

        // Ambil beberapa produk dan layanan
        $produks = Produk::whereNull('deleted_at')->latest('ID_PRODUK')->take(5)->get();
        $layanans = Layanan::whereNull('deleted_at')->latest('ID_LAYANAN')->take(5)->get();

        return view('cs.dashboard', compact(
            'totalCustomer',
            'totalHewan',
            'customers',
            'hewans',
            'produks',
            'layanans'
        ));
    }
}
