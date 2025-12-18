<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'USERNAME' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt([
            'USERNAME' => $credentials['USERNAME'],
            'password' => $credentials['password'],
        ])) {
            return back()->withErrors([
                'USERNAME' => 'Username atau password salah',
            ]);
        }

        // ✅ WAJIB SETELAH LOGIN BERHASIL
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->isOwner()) {
            return redirect()->route('owner.dashboard');
        }

        if ($user->isCs()) {
            return redirect()->route('cs.dashboard');
        }

        if ($user->isKasir()) {
            return redirect()->route('kasir.dashboard');
        }

        // fallback (jika ID_JABATAN tidak valid)
        Auth::logout();

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
