<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Siswa;
use App\Models\Prodi;
use App\Models\IpkRecord;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function admin()
    {
        if (Gate::allows('access-admin')) {
            $user = Auth::user();
            $jumlahMahasiswa = Siswa::count();
            $jumlahProdi = Prodi::count();
            $rataRataIPK = IpkRecord::avg('ipk');
            $jumlahMahasiswaPerAngkatan = Siswa::select('angkatan', DB::raw('count(*) as total'))
                                                ->groupBy('angkatan')
                                                ->get();
            $xAxisData = []; 
            $seriesData = []; 
            $angkatanData = Siswa::select('angkatan', DB::raw('avg(ipk_records.ipk) as avg_ipk'))
                                    ->join('ipk_records', 'siswa.id', '=', 'ipk_records.siswa_id')
                                    ->groupBy('angkatan')
                                    ->orderBy('angkatan', 'asc')
                                    ->get();
    
            foreach ($angkatanData as $data) {
                $xAxisData[] = "Angkatan " . $data->angkatan;
                $seriesData[] = round($data->avg_ipk, 2);
            }
            return view('admin.dashboard', [
                'user' => $user,
                'jumlahMahasiswa' => $jumlahMahasiswa,
                'jumlahProdi' => $jumlahProdi,
                'rataRataIPK' => $rataRataIPK,
                'jumlahMahasiswaPerAngkatan' => $jumlahMahasiswaPerAngkatan,
                'xAxisData' => $xAxisData,
                'seriesData' => $seriesData,
            ]);
        }
    
        return abort(403, 'Unauthorized action.');
    }
    

    public function user()
    {
        if (Gate::allows('access-user')) {
            $user = Auth::user();

            if ($user && $user->siswa) {
                return view('siswa.dashboard', ['siswa' => $user->siswa]);
            }
            else {
                return back()->withErrors('Tidak ada data siswa yang tersedia untuk pengguna ini.');
            }
            return view('siswa.dashboard'); 
        }

        return abort(403, 'Unauthorized action.');
    }
}
