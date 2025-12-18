<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        // 1️⃣ VALIDASI INPUT
        $request->validate([
            'USERNAME' => 'required',
            'PASSWORD' => 'required',
        ]);

        // 2️⃣ COBA LOGIN
        if (!Auth::attempt([
            'USERNAME' => $request->USERNAME,
            'password' => $request->PASSWORD,
        ])) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah',
            ], 401);
        }

        $user = Auth::user();

        // 3️⃣ ROLE CHECK → HANYA CS (ID_JABATAN = 2)
        if ($user->ID_JABATAN != 2) {
            Auth::logout();

            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Hanya Customer Service.',
            ], 403);
        }

        // 4️⃣ RESPONSE JSON (UNTUK FLUTTER)
        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->ID_PEGAWAI,
                'nama' => $user->NAMA_PEGAWAI,
                'username' => $user->USERNAME,
                'role' => 'CS',
            ],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

}
