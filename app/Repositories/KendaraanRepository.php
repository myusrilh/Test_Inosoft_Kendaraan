<?php

namespace App\Repositories;

use App\Models\Kendaraan;
use Illuminate\Support\Facades\DB;

class KendaraanRepository{
    
    public function getAllMotor(){
        
        $getMotor = Kendaraan::where('tipe_kendaraan','=','motor')->get();
        return $getMotor;
        
    }
    public function getAllMobil(){
        
        $getMobil = Kendaraan::where('tipe_kendaraan','=','mobil')->get();
        return $getMobil;
        
    }
        
    public function getPenjualan(){
        $getPenjualan = Kendaraan::where('terjual','=',true)->get();
        return $getPenjualan;
    }

    public function getPenjualanMotor(){
        $getPenjualanMotor = Kendaraan::where('terjual','=',true)
            ->where('tipe_kendaraan','=','motor')
            ->get();
        return $getPenjualanMotor;
    }
        
    public function getPenjualanMobil(){
        $getPenjualanMobil = Kendaraan::where('terjual','=',true)
            ->where('tipe_kendaraan','=','mobil')
            ->get();
        return $getPenjualanMobil;
    }
    public function getStockMotor(){
        $getStockMotor = Kendaraan::where([
            ['terjual','=',false],
            ['tipe_kendaraan','=','motor'],
            ])->get();
        return $getStockMotor;
    }
        
    public function getStockMobil(){
        $getStockMobil = Kendaraan::where([
            ['terjual','=',false],
            ['tipe_kendaraan','=','mobil'],
            ])->get();
        return $getStockMobil;
    }
        
    public function store($data){
        $lastValue = DB::table('kendaraans')->orderBy('id_kendaraan', 'desc')->first();
        
        $data['id_kendaraan'] = $lastValue['id_kendaraan'] + 1;
        return Kendaraan::create($data);
    }
    public function getAllKendaraan(){
        return Kendaraan::all();
    }

    public function update($data){
        
        $kendaraan = Kendaraan::where('id_kendaraan',$data['id_kendaraan']);
        
        return $kendaraan->update($data);

    }
    public function findKendaraanById($id){
        return Kendaraan::where('id_kendaraan',$id)->get();
    }

    public function deleteKendaraanById($id){
        $kendaraan = Kendaraan::where('id_kendaraan',$id);
        $delete = $kendaraan->delete();
        return $delete;
    }
}

