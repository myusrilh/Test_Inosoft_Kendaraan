<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mobils')->insert([
            'mesin' => 'diesel',
            'kapasitas_penumpang' => '6 orang',
            'tipe' => 'SUV'
        ]);
    }
}
