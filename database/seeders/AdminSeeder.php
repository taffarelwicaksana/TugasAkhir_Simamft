<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Data admin dengan detail adminDetails
        $adminDetails = [
            ['nama_admin' => 'Admin One', 'email_sso' => 'adminone@staff.undip.ac.id', 'NIP' => '9876543210'],
            ['nama_admin' => 'Admin Two', 'email_sso' => 'admintwo@staff.undip.ac.id', 'NIP' => '1234567890'],
        ];

        // Loop untuk memasukkan setiap admin ke dalam tabel users dan admin
        foreach ($adminDetails as $adminData) {
            // Cari user berdasarkan NIP
            $user = User::where('nim_nip', $adminData['NIP'])->first();

            // Buat record di tabel admin menggunakan user_id dari user yang baru dibuat
            Admin::create([
                'user_id' => $user->id, // Ambil ID user yang baru dibuat
                'NIP' => $adminData['NIP'], // Simpan NIP di tabel admin
                'nama_admin' => $adminData['nama_admin'],
                'email_sso' => $adminData['email_sso'], // Pastikan email_sso sesuai dengan adminDetails
            ]);
        }
    }
}
