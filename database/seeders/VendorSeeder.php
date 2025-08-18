<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vendors')->insert([
            ['id_vendor' => 1, 'nama_vendor' => 'PT. AGRA JAYA', 'alamat_vendor' => 'Jl. KH. Hasyim Ashari Kav. DPR Blok A. No.213 Kel. Kenanga Kec. Cipondoh', 'kota' => 'Tangerang', 'up_vendor' => 'Tulus', 'no_telp' => '-', 'email_vendor' => 'agra_jaya_zoom@yahoo.com'],
            ['id_vendor' => 2, 'nama_vendor' => 'PT. CAHAYA LESTARI', 'alamat_vendor' => 'Jl. Raya Lingkar Timur Kompleks Pergudangan Sinar  Buduran III Blok C-13', 'kota' => 'Sidoarjo', 'up_vendor' => 'Fang Fang', 'no_telp' => '082244430921', 'email_vendor' => '-'],
            ['id_vendor' => 4, 'nama_vendor' => 'PT. Manggala Pastika Persada', 'alamat_vendor' => 'Rukan Sentra Niaga Puri Indah Blok T6 No. 39', 'kota' => 'Jakarta 11610', 'up_vendor' => 'Office Art', 'no_telp' => '-', 'email_vendor' => '-'],
            ['id_vendor' => 5, 'nama_vendor' => 'Aris Furniture', 'alamat_vendor' => 'Jl. Beringin Selatan II No.9 Sambikerep ', 'kota' => 'Surabaya', 'up_vendor' => 'Aris', 'no_telp' => '083863040831', 'email_vendor' => '-'],
            ['id_vendor' => 6, 'nama_vendor' => 'Astana Living', 'alamat_vendor' => 'Jl. Cempaka Putih Tengah 1 No.5G - 5H Cempaka Putih', 'kota' => 'Jakarta Pusat - Indonesia 1051', 'up_vendor' => 'Thania ', 'no_telp' => '085695225282', 'email_vendor' => '-'],
            ['id_vendor' => 7, 'nama_vendor' => 'Zoom', 'alamat_vendor' => 'Jl. KH. Hasyim Ashari Kav. DPR Blok A, No.213 Kel. Kenanga Kec. Cipondoh', 'kota' => 'Kota Tangerang 15146', 'up_vendor' => 'Tulus', 'no_telp' => '0877-7135-7487', 'email_vendor' => '-'],
            ['id_vendor' => 8, 'nama_vendor' => 'Saikhu', 'alamat_vendor' => '-', 'kota' => '-', 'up_vendor' => '-', 'no_telp' => '-', 'email_vendor' => '-'],
            ['id_vendor' => 9, 'nama_vendor' => 'PT. Aneka Interindo Lestari', 'alamat_vendor' => '-', 'kota' => 'Surabaya', 'up_vendor' => 'Ardan', 'no_telp' => '085697135740', 'email_vendor' => '-'],
            ['id_vendor' => 10, 'nama_vendor' => 'PT. Satya Langgeng Sentosa', 'alamat_vendor' => '-', 'kota' => 'Surabaya', 'up_vendor' => 'Anisa', 'no_telp' => '-', 'email_vendor' => '-'],
            ['id_vendor' => 11, 'nama_vendor' => 'Heri Kaca', 'alamat_vendor' => 'Surabaya', 'kota' => 'Surabaya', 'up_vendor' => 'Pak Heri', 'no_telp' => '085330551497', 'email_vendor' => 'herikaca@gmail.com'],
            ['id_vendor' => 12, 'nama_vendor' => 'OneMed-Medicom MERR', 'alamat_vendor' => 'Ruko Icon 21 R51-52, MERR, 60117, Semolowaru, Kec. Sukolilo, Kota SBY, Jawa Timur 60117', 'kota' => 'Surabaya', 'up_vendor' => '-', 'no_telp' => '(031) 99005026', 'email_vendor' => '-'],
            ['id_vendor' => 13, 'nama_vendor' => 'Ibu Siska', 'alamat_vendor' => 'Tempat', 'kota' => 'Surabaya', 'up_vendor' => '-', 'no_telp' => '-', 'email_vendor' => '-'],
            ['id_vendor' => 14, 'nama_vendor' => 'Zelmi MUA', 'alamat_vendor' => 'Surabaya', 'kota' => 'Surabaya', 'up_vendor' => 'Zelmi', 'no_telp' => '082245269979', 'email_vendor' => '-'],
        ]);
    }
}
