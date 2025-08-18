<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clients')->insert([
            ['id_client' => 1, 'nama_client' => 'PT. Contoh Satu', 'alamat_client' => 'Jl. Mawar No.1', 'up' => 'Budi', 'upsph' => '081234567890'],
            ['id_client' => 2, 'nama_client' => 'PT. Contoh Dua', 'alamat_client' => 'Jl. Melati No.2', 'up' => 'Ani', 'upsph' => '081298765432'],
            ['id_client' => 3, 'nama_client' => 'CV. Contoh Tiga', 'alamat_client' => 'Jl. Anggrek No.3', 'up' => 'Joko', 'upsph' => '089876543210'],
        ]);
    }
}
