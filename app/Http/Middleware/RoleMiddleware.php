<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk menggunakan logging


class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->role->nama_role, $roles)) {
            // Jika user tidak terautentikasi atau role tidak sesuai
            return redirect('/login')->withErrors('Access is denied.');
        }

        return $next($request);
    }
}