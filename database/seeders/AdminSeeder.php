<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun Admin
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@sekolah.com',
            'password' => Hash::make('panitia'),
            'role'     => 'admin',
        ]);

        // Buat akun Guru
        User::create([
            'name'     => 'Bu Sari (Guru)',
            'email'    => 'guru@sekolah.com',
            'password' => Hash::make('password'),
            'role'     => 'guru',
        ]);

        // Buat akun Siswa
        User::create([
            'name'     => 'Ahmad Siswa',
            'email'    => 'siswa@sekolah.com',
            'password' => Hash::make('password'),
            'role'     => 'siswa',
        ]);
    }
}