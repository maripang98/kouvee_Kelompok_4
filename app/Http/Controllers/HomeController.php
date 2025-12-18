<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Layanan;

class HomeController extends Controller
{
     public function index()
    {
        $produks = Produk::latest('ID_PRODUK')->take(4)->get();
        $layanans = Layanan::latest('ID_LAYANAN')->take(4)->get();

        return view('home', compact('produks', 'layanans'));
    }
    
}
