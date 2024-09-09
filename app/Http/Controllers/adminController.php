<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $user = Auth::user();
        $siswas = Siswa::with('prodi')->get(); // Ensure to load Prodi data
        $prodis = Prodi::all(); // Needed for dropdown in modal
        return view('admin.tabel-siswa', compact('siswas', 'prodis','user'));
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $request->validate([
            'nama' => 'required',
            'NIM' => 'required|numeric',
            'prodi_id' => 'required|exists:prodis,id',
            // Add other validation as necessary
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());
        return back()->with('success', 'Data siswa berhasil diperbarui.');
    }
}
