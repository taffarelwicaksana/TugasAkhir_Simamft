<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

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

    private function redirectBasedOnRole()
    {
        $user = Auth::user();

        switch ($user->role->nama_role) {
            case 'admin':
                return redirect()->route('dashboard.admin'); 
            case 'orangtua':
                return redirect()->route('dashboard.user'); 
            default:
                Auth::logout();
                return redirect('/login')->withErrors('Access denied. Please contact support.');
        }
    }
}
