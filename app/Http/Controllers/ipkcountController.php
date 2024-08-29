<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\IpkRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ipkcountController extends Controller
{
    public function calculateAndSaveIPK($siswaId)
    {
        $siswa = Siswa::find($siswaId);

        if (!$siswa) {
            return null; // Atau lemparkan exception jika siswa tidak ditemukan
        }

        // Inisialisasi total nilai dan total SKS
        $totalNilai = 0;
        $totalSKS = 0;
        $ipkPerSemester = [];

        // Loop untuk menghitung total nilai dan total SKS berdasarkan semester
        for ($i = 1; $i <= 8; $i++) {
            $nilaiField = 'nilai_s' . $i;
            $sksField = 'sks_s' . $i;

            $nilai = $siswa->$nilaiField;
            $sks = $siswa->$sksField;

            // Skip semester jika data nilai atau sks kosong
            if ($nilai !== null && $sks !== null && $sks > 0) {
                $totalNilai += $nilai * $sks;
                $totalSKS += $sks;
                $ipkPerSemester[$i] = round($nilai, 2); // Simpan IPK per semester
            }
        }

        // Hitung IPK total
        $ipk = $totalSKS > 0 ? round($totalNilai / $totalSKS, 2) : 0;

        // Simpan hasil perhitungan IPK ke dalam tabel ipk_records
        $ipkRecord = IpkRecord::updateOrCreate(
            ['siswa_id' => $siswa->id],
            [
                'ipk' => $ipk,
                'total_sks' => $totalSKS,
            ]
        );

        return $ipkRecord;
    }
}

