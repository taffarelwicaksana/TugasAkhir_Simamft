<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data admin users
        $adminDetails = [
            ['nama_admin' => 'Admin One', 'email_sso' => 'adminone@staff.undip.ac.id', 'NIP' => '9876543210'],
            ['nama_admin' => 'Admin Two', 'email_sso' => 'admintwo@staff.undip.ac.id', 'NIP' => '1234567890'],
        ];

        // Create admin users
        foreach ($adminDetails as $admin) {
            User::create([
                'nim_nip' => $admin['NIP'], // NIP digunakan sebagai nim_nip
                'password' => Hash::make('321'), // Password untuk admin
                'nama' => $admin['nama_admin'],
                'role_id' => 1 // Role ID untuk admin
            ]);
        }

        // Data siswa users
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

        // Create parent users
        foreach ($siswaDetails as $siswa) {
            User::create([
                'nim_nip' => $siswa['NIM'], // NIM digunakan sebagai nim_nip
                'password' => Hash::make('123'), // Password untuk orangtua
                'nama' => $siswa['nama'],
                'role_id' => 2 // Role ID untuk orangtua
            ]);
        }
    }
}
