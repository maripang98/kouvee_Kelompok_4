<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $pegawai = Auth::user();

        $roleMap = [
            'kasir' => 1,
            'cs'    => 2,
            'owner' => 3,
        ];

        if (!isset($roleMap[$role]) || $pegawai->ID_JABATAN != $roleMap[$role]) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES');
        }

        return $next($request);
    }
}
