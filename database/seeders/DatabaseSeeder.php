<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            //roleSeeder::class,
            // FakultasSeeder::class,
            // ProdiSeeder::class,
            // DosbingSeeder::class,
            UserSeeder::class,
            // AdminSeeder::class,
            // SiswaSeeder::class,
        ]);
    }
}
