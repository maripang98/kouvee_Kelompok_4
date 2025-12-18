<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function apiIndex()
    {
        $layanan = Layanan::whereNull('deleted_at')->get();

        return response()->json([
            'data' => $layanan
        ], 200);
    }
}
