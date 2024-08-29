<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan Anda memiliki file ini di resources/views/auth/login.blade.php
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nim_nip' => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Redirect user berdasarkan role
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'loginError' => 'The provided credentials do not match our records.'
        ]);
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Fungsi bantu untuk mengarahkan user berdasarkan role
    private function redirectBasedOnRole()
    {
        $user = Auth::user();

        switch ($user->role->nama_role) {
            case 'admin':
                return redirect()->route('dashboard.admin'); // Asumsi Anda memiliki route ini
            case 'orangtua':
                return redirect()->route('dashboard.user'); // Asumsi Anda memiliki route ini
            default:
                Auth::logout();
                return redirect('/login')->withErrors('Access denied. Please contact support.');
        }
    }
}
