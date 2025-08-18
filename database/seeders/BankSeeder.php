<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            [
                'id' => 7,
                'nama_bank' => 'MANDIRI',
                'an' => 'Mariyadi',
                'ac' => '1410014470934'
            ],
            [
                'id' => 8,
                'nama_bank' => 'Bank Jatim',
                'an' => 'PT. Rajata Muda Bersaudara',
                'ac' => '0331332844'
            ],
            [
                'id' => 9,
                'nama_bank' => 'BANK SYARIAH INDONESIA',
                'an' => 'PT. Multi Power Abadi',
                'ac' => '8112728253'
            ],
            [
                'id' => 10,
                'nama_bank' => 'BCA',
                'an' => 'Septania Virgia N',
                'ac' => '7880294622'
            ],
            [
                'id' => 2,
                'nama_bank' => 'BNI Cabang Surabaya',
                'an' => 'PT. Multi Power Abadi',
                'ac' => '8112728253'
            ],
            [
                'id' => 11,
                'nama_bank' => 'MANDIRI',
                'an' => 'SEPTANIA VIRGIA NARUTHAMA',
                'ac' => '1420014044480'
            ],
            [
                'id' => 6,
                'nama_bank' => 'Mandiri KCP Surabaya Darmo Park',
                'an' => 'Mariyadi',
                'ac' => '141 001 447 0934'
            ],
            [
                'id' => 4,
                'nama_bank' => 'Mandiri Rajata',
                'an' => 'PT. Rajata Muda Bersaudara',
                'ac' => '140-00-0332844-1'
            ],
            [
                'id' => 3,
                'nama_bank' => 'Mandiri Rajata (Event)',
                'an' => 'PT. Rajata Muda Bersaudara',
                'ac' => '142-00-0272825-0'
            ],
            [
                'id' => 5,
                'nama_bank' => 'Mandiri Taspen Cabang Surabaya',
                'an' => 'PT. Multi Power Abadi',
                'ac' => '275 410 4632 134'
            ]
        ];

        foreach ($banks as $bank) {
            Bank::updateOrCreate(
                ['id' => $bank['id']],
                [
                    'nama_bank' => $bank['nama_bank'],
                    'an' => $bank['an'],
                    'ac' => $bank['ac']
                ]
            );
        }
    }
}
