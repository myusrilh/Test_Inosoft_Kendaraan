<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kendaraans')->insert([
            [
                'tahun_keluaran' => 2012,
                'warna' => 'kuning',
                'tipe_kendaraan' => 'mobil',
                'mesin' => 'diesel',
                'kapasitas_penumpang' => '6 orang',
                'tipe_transmisi' => null,
                'tipe_suspensi' => null,
                'tipe' => 'SUV',
                'harga' => 230000000
            ],
            [
                'tahun_keluaran' => 2010,
                'warna' => 'hitam',
                'tipe_kendaraan' => 'motor',
                'mesin' => '1 silinder',
                'kapasitas_penumpang' => null,
                'tipe' => null,
                'tipe_transmisi' => 'manual',
                'tipe_suspensi' => 'telescopic up',
                'harga' => 25000000
            ]
        ]);
    }
}
