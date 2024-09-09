<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {

        User::where('id', 13)->update([
            'password' => Hash::make('123'), // Password untuk orangtua
        ]);
    }
}

