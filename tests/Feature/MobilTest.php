<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use JWTAuth;

class MobilTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_show_penjualan_mobil()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/penjualan/mobil?token='.$token);

        $response->assertStatus(200);
    }

    public function test_show_stock_mobil()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/stock/mobil?token='.$token);

        $response->assertStatus(200);
    }

    public function test_show_mobil()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/show/mobil?token='.$token);

        $response->assertStatus(200);
    }
}
