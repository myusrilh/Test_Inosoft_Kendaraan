<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $strings = array(
            'mobil',
            'motor',
        );
        $key = array_rand($strings);
        if ($strings[$key] == 'motor') {
            return [
                'id_kendaraan' => $this->faker->numberBetween(0,1),
                'tahun_keluaran' => $this->faker->numberBetween(2000,2022),
                'warna' => $this->faker->colorName(),
                'harga' => $this->faker->numberBetween($min = 1000000, $max = 1000000000),
                'terjual' => $this->faker->boolean(),
                'tipe_kendaraan' => $strings[$key],
                'mesin' => $this->faker->company(),
                'tipe_suspensi' => $this->faker->userAgent(),
                'tipe_transmisi' => $this->faker->bloodType(),
            ];
        } else {
            return [
                'id_kendaraan' => $this->faker->numberBetween(0,1),
                'tahun_keluaran' => $this->faker->numberBetween(2000,2022),
                'warna' => $this->faker->colorName(),
                'harga' => $this->faker->numberBetween($min = 1000000, $max = 1000000000),
                'terjual' => $this->faker->boolean(),
                'tipe_kendaraan' => $strings[$key],
                'mesin' => $this->faker->company(),
                'kapasitas_penumpang' => $this->faker->userAgent(),
                'tipe' => $this->faker->bloodType(),
            ];
        }
    }
}
