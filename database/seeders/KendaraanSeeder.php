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
            'tahun_keluaran' => 2012,
            'warna' => 'kuning',
            'tipe_kendaraan' => 'mobil',
            'mesin' => 'diesel',
            'harga' => 230000000
        ],
        [
            'tahun_keluaran' => 2010,
            'warna' => 'hitam',
            'tipe_kendaraan' => 'motor',
            'mesin' => 'turbo',
            'harga' => 25000000
        ]);
    }
}
