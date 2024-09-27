<?php

namespace Database\Seeders;

use App\Models\Eselon;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eselon = [
            [
                'eselon' => '2A',
                'min_gol' => '15',
                'max_gol' =>  '17'
            ],
            [
                'eselon' => '2B',
                'min_gol' => '15',
                'max_gol' =>  '17'
            ],
            [
                'eselon' => '2C',
                'min_gol' => '12',
                'max_gol' =>  '16'
            ]
        ];

        Eselon::insert($eselon);
    }
}
