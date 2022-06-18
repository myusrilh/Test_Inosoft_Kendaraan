<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MotorService;
use Illuminate\Http\Response;

class MotorController extends Controller
{
    protected $motorService;
    public function __construct(MotorService $motorService){
        $this->motorService = $motorService;
    }

    public function showAllMotor(){
        $all = $this->motorService->getAllMotor();
        if($all->count() < 0){
            return response()->json([
                'success' => false,
                'data' => $all
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'data' => $all
        ], Response::HTTP_OK);
    }

    public function showStockMotor(){
        $stock = $this->motorService->getStockMotor();
        if($stock->count() <= 0){
            return response()->json([
                'success' => false,
                'stock' => 'Tidak ada stok',
                'data' => $stock

            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'stock'=>$stock->count(),
            'data' => $stock
        ], Response::HTTP_OK);
    }

    public function showPenjualanMotor(){
        $penjualan = $this->motorService->getPenjualanMotor();
        if($penjualan->count() <= 0){
            return response()->json([
                'success' => false,
                'jumlah_terjual'=>'Belum ada yang terjual',
                'data' => $penjualan
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'jumlah_terjual'=>$penjualan->count(),
            'data' => $penjualan
        ], Response::HTTP_OK);
    }
}
