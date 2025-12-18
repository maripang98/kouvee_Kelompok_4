<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukApiController extends Controller
{
public function apiIndex()
{
    $produk = Produk::all()->map(function ($p) {
        $p->GAMBAR_URL = $p->GAMBAR_PRODUK 
            ? url('storage/' . $p->GAMBAR_PRODUK)
            : 'https://via.placeholder.com/400x250?text=No+Image';
        return $p;
    });

    return response()->json([
        "data" => $produk
    ]);
}




}
