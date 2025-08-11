<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadmin123'), // password: superadmin123
            'role' => 'super_admin',
        ]);

        // Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // password: admin123
            'role' => 'admin',
        ]);

        // Karyawan
        User::create([
            'name' => 'Karyawan',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'), // password: user123
            'role' => 'karyawan',
        ])->employee()->create([
            'name' => 'Karyawan',
            'phone' => '08123456789',
            'emergency_phone' => '08123456789',
            'address' => 'Jl. Contoh Alamat No. 123',
            'nik' => '1234567890123456',
            'base_salary' => 5000000,
            'position' => 'Staff',
            'email' => 'user@example.com'
        ]);
    }
}
