<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function admin()
    {
        if (Gate::allows('access-admin')) {
            $siswa = Siswa::all(); // Fetch all students from the database
            return view('admin.dashboard', ['siswa' => $siswa]);
        }
    
        return abort(403, 'Unauthorized action.');
    }

    public function user()
    {
        if (Gate::allows('access-user')) {
            $user = Auth::user();

            if ($user && $user->siswa) {
                // Menampilkan data siswa pada dashboard siswa
                return view('siswa.dashboard', ['siswa' => $user->siswa]);
            }
            else {
                // Jika tidak ada data siswa, kirimkan pesan error ke view
                return back()->withErrors('Tidak ada data siswa yang tersedia untuk pengguna ini.');
            }
            return view('siswa.dashboard'); // Pastikan view ini tersedia di resources/views/siswa/dashboard.blade.php
        }

        return abort(403, 'Unauthorized action.');
    }
}
