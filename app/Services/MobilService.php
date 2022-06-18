<?php

namespace App\Services;

use App\Services\KendaraanService;
use App\Repositories\KendaraanRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MobilService extends KendaraanService{
    
    protected $mobilRepository;
    public function __construct(KendaraanRepository $kendaraanRepository){
        parent::__construct($kendaraanRepository);
        $this->mobilRepository = $kendaraanRepository;
    }
    
    public function validator($data){
        $d = parent::validator($data->all());

        $validator = Validator::make($d,[
            'kapasitas_penumpang' => 'required|string',
            'tipe' => 'required|string',
        ]);

        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $d;

    }

    public function getAllMobil(){
        return $this->mobilRepository->getAllMobil();
    }

    public function getStockMobil(){
        return $this->mobilRepository->getStockMobil();
    }

    public function getPenjualanMobil(){
        $this->mobilRepository->getPenjualanMobil();
    }
}