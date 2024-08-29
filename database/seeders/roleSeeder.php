<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create(['nama_role' => 'admin']);
        Role::create(['nama_role' => 'orangtua']);
    }
}
