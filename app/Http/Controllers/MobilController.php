<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MobilService;
use Illuminate\Http\Response;

class MobilController extends Controller
{
    protected $mobilService;
    public function __construct(MobilService $mobilService){
        $this->mobilService = $mobilService;
    }

    public function showAllMobil(){
        $all = $this->mobilService->getAllMobil();
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

    public function showStockMobil(){
        $stock = $this->mobilService->getStockMobil();
        if($stock->count() <= 0){
            return response()->json([
                'success' => false,
                'stock'=>'Stok tidak ada',
                'data' => $stock
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'stock'=>$stock->count(),
            'data' => $stock
        ], Response::HTTP_OK);
    }

    public function showPenjualanMobil(){
        $penjualan = $this->mobilService->getPenjualanMobil();
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
