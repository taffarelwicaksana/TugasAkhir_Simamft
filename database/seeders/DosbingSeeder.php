<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosbing;
use App\Models\Prodi;

class DosbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua prodi
        $prodis = Prodi::all();

        // Daftar dosbing per prodi
        $dosbingData = [
            [
                'nama_dosbing' => 'Dr. Ir. Bambang S.T., M.Eng.',
                'NIP' => '1980123456789001',
                'id_prodi' => 1, // Teknik Mesin
            ],
            [
                'nama_dosbing' => 'Prof. Dr. Rina S.T., M.T.',
                'NIP' => '1970123456789002',
                'id_prodi' => 1, // Teknik Mesin
            ],
            [
                'nama_dosbing' => 'Dr. Andi S.T., M.T.',
                'NIP' => '1975123456789003',
                'id_prodi' => 2, // Teknik Elektro
            ],
            [
                'nama_dosbing' => 'Prof. Dr. Agus S.T., M.T.',
                'NIP' => '1980123456789004',
                'id_prodi' => 2, // Teknik Elektro
            ],
            [
                'nama_dosbing' => 'Dr. Siti S.T., M.Ked.',
                'NIP' => '1972123456789005',
                'id_prodi' => 3, // Kedokteran Umum
            ],
            [
                'nama_dosbing' => 'Prof. Dr. Andri S.T., M.Sc.',
                'NIP' => '1969123456789006',
                'id_prodi' => 4, // Ilmu Komputer
            ],
            [
                'nama_dosbing' => 'Dr. Maria S.T., M.Sc.',
                'NIP' => '1982123456789007',
                'id_prodi' => 5, // Biologi
            ],
        ];

        // Masukkan data dosbing ke dalam tabel
        foreach ($dosbingData as $data) {
            Dosbing::create($data);
        }
    }
}
