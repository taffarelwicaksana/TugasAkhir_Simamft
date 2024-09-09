<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Prodi;
use App\Models\IpkRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ipkController extends Controller
{
    public function showIPK()
    {
        if (Gate::allows('access-user')) {
            $user = Auth::user();

            if ($user && $user->siswa) {
                $siswa = $user->siswa;
                $ipkRecord = IpkRecord::where('siswa_id', $siswa->id)->first();

                if ($ipkRecord) {
                    $ipkPerSemester = [];
                    for ($i = 1; $i <= 8; $i++) {
                        $nilaiField = 'nilai_s' . $i;
                        $ipkPerSemester[$i] = $siswa->$nilaiField !== null ? number_format($siswa->$nilaiField, 2) : '-';
                    }
                    return view('siswa.ipk', [
                        'siswa' => $siswa,
                        'ipk' => $ipkRecord->ipk,
                        'totalSKS' => $ipkRecord->total_sks,
                        'ipkPerSemester' => $ipkPerSemester
                    ]);
                } else {
                    return back()->withErrors('Data IPK belum tersedia untuk siswa ini.');
                }
            } else {
                return back()->withErrors('Tidak ada data siswa yang tersedia untuk pengguna ini.');
            }
        }
        return abort(403, 'Unauthorized action.');
    }
    public function prodiIPK()
    {
        if (!Gate::allows('access-user')) {
            return abort(403, 'Unauthorized action.');
        }

        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        if (!$siswa || !$siswa->prodi) {
            return back()->withErrors('Tidak ada data siswa yang tersedia untuk pengguna ini.');
        }
        $ipkRecord = IpkRecord::where('siswa_id', $siswa->id)->first();
        if (!$ipkRecord) {
            return back()->withErrors('Data IPK belum tersedia untuk siswa ini.');
        }

        $averageIPKProdi = $this->calculateAverageIPK($siswa->prodi_id);
        $persentaseIPK = $this->calculateIPKPercentage($ipkRecord->ipk, $averageIPKProdi);

        return view('siswa.prodi', [
            'siswa' => $siswa,
            'ipk' => $ipkRecord->ipk,
            'totalSKS' => $ipkRecord->total_sks,
            'averageIPKProdi' => $averageIPKProdi,
            'persentaseIPK' => $persentaseIPK
        ]);
    }

    public function angkatanIPK()
    {
        if (!Gate::allows('access-user')) {
            return abort(403, 'Unauthorized action.');
        }

        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        if (!$siswa || !$siswa->prodi) {
            return back()->withErrors('Tidak ada data siswa yang tersedia untuk pengguna ini.');
        }

        $ipkRecord = IpkRecord::where('siswa_id', $siswa->id)->first();
        if (!$ipkRecord) {
            return back()->withErrors('Data IPK belum tersedia untuk siswa ini.');
        }

        $dataIpkAngkatan = $this->getIPKAngkatanData($siswa->prodi_id);
        $averageIPKAngkatan = $this->calculateAverageIPKAngkatan($siswa->prodi_id, $siswa->angkatan);
        $persentaseIPK = $this->calculateIPKDifferencePercentage($ipkRecord->ipk, $averageIPKAngkatan);

        return view('siswa.angkatan', [
            'siswa' => $siswa,
            'ipk' => $ipkRecord->ipk,
            'totalSKS' => $ipkRecord->total_sks,
            'averageIPKAngkatan' => $averageIPKAngkatan,
            'persentaseIPK' => $persentaseIPK,
            'dataIpkAngkatan' => $dataIpkAngkatan
        ]);
    }

    
    public function getIPKAngkatanData($prodiId)
    {
        $angkatans = Siswa::where('prodi_id', $prodiId)
            ->select('angkatan')
            ->distinct()
            ->pluck('angkatan')
            ->toArray();

        $dataIpkAngkatan = [];

        foreach ($angkatans as $angkatan) {
            $averageIPK = $this->calculateAverageIPKAngkatan($prodiId, $angkatan);
            $dataIpkAngkatan['labels'][] = "Angkatan " . $angkatan;
            $dataIpkAngkatan['data'][] = $averageIPK;
        }

        return $dataIpkAngkatan;
    }

    private function calculateAverageIPK($prodiId)
    {
        $ipkRecords = IpkRecord::whereHas('siswa', function ($query) use ($prodiId) {
            $query->where('prodi_id', $prodiId);
        })->get();

        if ($ipkRecords->isEmpty()) {
            return 0;
        }

        $totalIPK = $ipkRecords->sum('ipk');
        return $totalIPK / $ipkRecords->count();
    }

    private function calculateIPKPercentage($ipk, $averageIPKProdi)
    {
        if ($averageIPKProdi == 0 || $ipk == 0) {
            return 0;
        }

        return (($ipk - $averageIPKProdi) / $averageIPKProdi) * 100;
    }

    private function calculateAverageIPKAngkatan($prodiId, $angkatan)
    {
        $ipkRecords = IpkRecord::whereHas('siswa', function ($query) use ($prodiId, $angkatan) {
            $query->where('prodi_id', $prodiId)->where('angkatan', $angkatan);
        })->get();

        if ($ipkRecords->isEmpty()) {
            return 0;
        }

        $totalIPK = $ipkRecords->sum('ipk');
        return $totalIPK / $ipkRecords->count();
    }

    private function calculateIPKDifferencePercentage($ipk, $averageIPKAngkatan)
    {
        if ($averageIPKAngkatan == 0 || $ipk == 0) {
            return 0;
        }

        return (($ipk - $averageIPKAngkatan) / $averageIPKAngkatan) * 100;
    }
}
