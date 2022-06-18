<?php

namespace App\Services;

use App\Services\KendaraanService;
use App\Repositories\KendaraanRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MotorService extends KendaraanService{
    
    protected $motorRepository;
    public function __construct(KendaraanRepository $kendaraanRepository){
        parent::__construct($kendaraanRepository);
        $this->motorRepository = $kendaraanRepository;
    }
    
    public function validator($data){
        $d = parent::validator($data->all());

        $validator = Validator::make($d,[
            'tipe_suspensi' => 'required|string',
            'tipe_transmisi' => 'required|string',
        ]);

        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $d;

    }

    public function getAllMotor(){
        return $this->motorRepository->getAllMotor();
    }

    public function getStockMotor(){
        return $this->motorRepository->getStockMotor();
    }

    public function getPenjualanMotor(){
        return $this->motorRepository->getPenjualanMotor();
    }
}