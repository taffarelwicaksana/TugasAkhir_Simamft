<?php

namespace App\Http\Controllers;
use App\Models\Siswa; 

use App\Models\IpkRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class prodiController extends Controller
{
    public function prodiIPK()
    {
        $siswa = Siswa::where('nim', auth()->user()->nim)->first(); // Asumsi user sudah login dan memiliki nim
        $ipk = $siswa->calculateIPK(); // Asumsi ada fungsi ini pada model Siswa
        $totalSKS = $siswa->calculateTotalSKS(); // Asumsi ada fungsi ini
        $averageIPKProdi = $siswa->prodi->calculateAverageIPK(); // Asumsi model Prodi memiliki fungsi ini
        $persentaseIPK = $siswa->calculateIPKPercentage(); // Asumsi ada fungsi ini pada model Siswa

        return view('yourviewname', compact('siswa', 'ipk', 'totalSKS', 'averageIPKProdi', 'persentaseIPK'));
    }
}
