<?php

namespace App\Services;

use App\Repositories\KendaraanRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class KendaraanService{
    protected $kendaraanRepository;

    public function __construct(KendaraanRepository $kendaraanRepository){
        $this->kendaraanRepository = $kendaraanRepository;
    }

    public function validator($request){
        $validator = Validator::make($request, [
            'tahun_keluaran' => 'required|size:4',
            'warna' => 'required',
            'harga' => 'required',
            'tipe_kendaraan' => 'required|string',
            'terjual' => 'required|boolean',
            'mesin' => 'required|string',
        ]);
        
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $request;
    }

    public function getAllKendaraan(){
        return $this->kendaraanRepository->getAllKendaraan();
    }

    public function store($data){
        return $this->kendaraanRepository->store($data);
    }

    public function update($data, $id){
        return $this->kendaraanRepository->update($data, $id);
    }

    public function deleteKendaraanById($id){
        return $this->kendaraanRepository->deleteKendaraanById($id);
    }

    public function findKendaraanById($id){
        return $this->kendaraanRepository->findKendaraanById($id);
    }

    public function getAllPenjualan(){
        return $this->kendaraanRepository->getPenjualan();
    }

}