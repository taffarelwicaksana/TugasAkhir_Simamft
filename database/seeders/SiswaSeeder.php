<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $angkatans = [
            '2020' => 9,
            '2021' => 7,
            '2022' => 5,
        ];

        $prodis = [1, 2, 3, 4, 5]; // Asumsikan ID Prodi yang ada
        $fakultasMapping = [
            1 => 1, // Mapping Prodi ID ke Fakultas ID
            2 => 1, // Teknik Mesin dan Elektro ke Fakultas Teknik
            3 => 2, // Kedokteran Umum ke Fakultas Kedokteran
            4 => 3, // Ilmu Komputer ke Fakultas Ilmu Komputer
            5 => 3, // Biologi ke Fakultas Ilmu Komputer
        ];
        $dosbingIds = [1, 2, 3, 4, 5]; // Asumsikan ID Dosbing yang ada

        $siswaDetails = [
            ['nama' => 'Budi Santoso', 'NIM' => '2020001'],
            ['nama' => 'Dewi Kartika', 'NIM' => '2020002'],
            ['nama' => 'Rian Pratama', 'NIM' => '2020003'],
            ['nama' => 'Siti Aisyah', 'NIM' => '2020004'],
            ['nama' => 'Agus Wijaya', 'NIM' => '2020005'],
            ['nama' => 'Indah Permata', 'NIM' => '2020006'],
            ['nama' => 'Rudi Hartono', 'NIM' => '2020007'],
            ['nama' => 'Maya Sari', 'NIM' => '2020008'],
            ['nama' => 'Andi Saputra', 'NIM' => '2020009'],
            ['nama' => 'Lina Marlina', 'NIM' => '2020010'],
        ];

        $namaOrangtua = [
            'Santoso', 'Kartika', 'Pratama', 'Aisyah', 'Wijaya',
            'Permata', 'Hartono', 'Sari', 'Saputra', 'Marlina'
        ];

        foreach ($siswaDetails as $index => $siswa) {
            $angkatan = array_keys($angkatans)[$index % count($angkatans)];
            $semesterBerjalan = $angkatans[$angkatan];
            $prodiId = $prodis[$index % count($prodis)];
            $fakultasId = $fakultasMapping[$prodiId];
            $dosbingId = $dosbingIds[$index % count($dosbingIds)];
            
            $siswaData = [
                'nama' => $siswa['nama'],
                'NIM' => $siswa['NIM'],
                'no_hp' => '0812345678' . $index,
                'nama_orangtua' => $namaOrangtua[$index],
                'prodi_id' => $prodiId,
                'fakultas_id' => $fakultasId,
                'dosbing_id' => $dosbingId,
                'user_id' => $index + 3, // User ID untuk parent mulai dari ID 3
                'semester_berjalan' => 'Semester ' . $semesterBerjalan,
                'angkatan' => $angkatan,
                'email_sso' => 'student' . $index . '@students.undip.ac.id',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            // Tambahkan nilai dan SKS berdasarkan semester berjalan
            for ($i = 1; $i <= 8; $i++) {
                if ($i <= $semesterBerjalan - 1) {
                    $siswaData['nilai_s' . $i] = rand(2.5 * 100, 4 * 100) / 100; // Nilai antara 2.50 - 4.00
                    $siswaData['sks_s' . $i] = rand(19, 22); // SKS antara 19 - 22
                } else {
                    $siswaData['nilai_s' . $i] = null;
                    $siswaData['sks_s' . $i] = null;
                }
            }

            Siswa::create($siswaData);
        }
    }
}
