<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use JWTAuth;

class MotorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_motor()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/show/motor?token='.$token);

        $response->assertStatus(200);
    }
    public function test_show_stock_motor()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/stock/motor?token='.$token);

        $response->assertStatus(200);
    }
    public function test_penjualan_motor()
    {
        $user = User::where('email', "jokodoe@gmail.com")->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->get('/api/penjualan/motor?token='.$token);

        $response->assertStatus(200);
    }
}
