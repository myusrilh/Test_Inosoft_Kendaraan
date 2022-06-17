<?php

use App\Models\Kendaraan;

class KendaraanRepository{

    public function getAll(){
        return Kendaraan::all();
    }

    public function getMotorAll(){
        
        $getMobil = Kendaraan::where([
            'tipe_kendaraan','=','mobil'
            ])->get();
        return $getMobil;
        
    }
    public function getMobilAll(){
        
        $getMobil = Kendaraan::where([
            'tipe_kendaraan','=','mobil'
            ])->get();
        return $getMobil;
        
    }

    public function store($data){
        // ['tipe_kendaraan','warna','tahun_keluaran','mesin','harga','tipe','kapasitas_penumpang','tipe_suspensi','tipe_transmisi']
        return Kendaraan::create($data);
    }

}

