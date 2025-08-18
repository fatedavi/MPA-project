<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Perusahaan;

class PerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        $perusahaan = [
            [
                'nama_perusahaan' => 'PT. Multi Power Abadi',
                'alamat' => 'Jl. Gunung Anyar Tambak IV No.50 Surabaya',
                'pemilik' => 'Mariyadi ST, MM',
                'kota' => 'Surabaya',
                'gambar' => 'multipower.jpg',
                'email' => 'multipowerabadi@gmail.com'
            ],
            [
                'nama_perusahaan' => 'Rajata Wedding',
                'alamat' => 'Jl. Gunung Anyar Tambak IV No.50 Surabaya',
                'pemilik' => 'Mariyadi ST, MM',
                'kota' => 'Surabaya',
                'gambar' => 'rajata.jpg',
                'email' => 'rajata.wedding@gmail.com'
            ],
            [
                'nama_perusahaan' => 'Ramada Event Organizer',
                'alamat' => 'Jl. Gunung Anyar Tambah IV No.50 Surabaya',
                'pemilik' => 'Mariyadi ST, MM',
                'kota' => 'Surabaya',
                'gambar' => 'ramada.jpg',
                'email' => 'rajata.organizer@gmail.com'
            ],
            [
                'nama_perusahaan' => 'Nains Media',
                'alamat' => 'Jl. Gunung Anyar Tambak IV No.50 Surabaya',
                'pemilik' => 'Mariyadi ST, MM',
                'kota' => 'Surabaya',
                'gambar' => 'nainsmedia.jpg',
                'email' => 'nainstv@gmail.com'
            ]
        ];

        foreach ($perusahaan as $data) {
            Perusahaan::create($data);
        }
    }
}
