<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motors')->insert([
            'mesin' => '1 silinder',
            'tipe_transmisi' => 'manual',
            'tipe_suspensi' => 'telescopic up'
        ]);
    }
}
