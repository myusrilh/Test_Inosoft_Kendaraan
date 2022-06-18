<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Kendaraan;
use App\Models\User;
use JWTAuth;
use Illuminate\Support\Str;

class KendaraanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_show()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/show?token='.$token);

        $response->assertStatus(200);
    }
    public function test_show_penjualan()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/show/penjualan?token='.$token);

        $response->assertStatus(200);
    }

    public function test_show_by_id_kendaraan()
    {
        
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $id = random_int(0,5);

        $response = $this->get('api/show/kendaraan/'.$id.'?token='.$token);

        $response->assertStatus(200);
    }

    public function test_post_kendaraan()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $form = [
            "tahun_keluaran" => random_int(2000,2022),
            "warna" => Str::random(6),
            "harga" => 120000000,
            "terjual" => false,
            "tipe_kendaraan" => "mobil",
            "mesin" => "diesel",
            "tipe_suspensi" => null,
            "tipe_transmisi" => null,
            "tipe" => Str::random(3),
            "kapasitas_penumpang" => random_int(1,6)."orang",
            
        ];

        
        $response = $this->post('api/store/?token='.$token, $form);

        $response->assertStatus(200);
    }
    public function test_update_kendaraan()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $id = random_int(0,2);

        $form = [
            'id_kendaraan' => $id,
            'tahun_keluaran' => random_int(2000,2022),
            'warna' => Str::random(6),
            'harga' => 150000000,
            'terjual' => false,
            'tipe_kendaraan' => "mobil",
            'mesin' => "diesel",
            'tipe_suspensi' => null,
            'tipe_transmisi' => null,
            'tipe' => Str::random(3),
            'kapasitas_penumpang' => random_int(1,6)." orang",
        ];

        
        $response = $this->post('api/update/?token='.$token, $form);

        $response->assertStatus(200);
    }

    public function test_delete_by_id_kendaraan()
    {
        
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $id = random_int(0,5);

        $response = $this->delete('api/delete/'.$id.'?token='.$token);

        $response->assertStatus(200);
    }
}
