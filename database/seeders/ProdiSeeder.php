<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $prodiData = [
            ['nama_prodi' => 'Teknik Mesin', 'id_fakultas' => 1],
            ['nama_prodi' => 'Teknik Elektro', 'id_fakultas' => 1],
            ['nama_prodi' => 'Kedokteran Umum', 'id_fakultas' => 2],
            ['nama_prodi' => 'Gizi', 'id_fakultas' => 2],
            ['nama_prodi' => 'Ilmu Komputer', 'id_fakultas' => 3],
        ];

        foreach ($prodiData as $data) {
            Prodi::create($data);
        }
    }
}

