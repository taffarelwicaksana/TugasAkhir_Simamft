<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    public function run()
    {
        $fakultasNames = ['Teknik', 'Kedokteran', 'Ilmu Komputer'];
        foreach ($fakultasNames as $name) {
            Fakultas::create(['nama_fakultas' => $name]);
        }
    }
}
