<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan;
use App\Models\Customer;

class DashboardCsController extends Controller
{
     public function index()
    {
        // Ambil total dari tabel customer dan hewan
        $totalCustomer = Customer::count();
        $totalHewan = Hewan::count();

        // Ambil 5 data terbaru untuk preview
        $customers = Customer::latest('ID_CUSTOMER')->take(5)->get();
        $hewans = Hewan::with('customer')->latest('ID_HEWAN')->take(5)->get();

        // Kirim ke view
        return view('cs.dashboard', compact(
            'totalCustomer',
            'totalHewan',
            'customers',
            'hewans'
        ));
    }
}
