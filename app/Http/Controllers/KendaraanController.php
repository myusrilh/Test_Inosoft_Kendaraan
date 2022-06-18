<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Services\KendaraanService;
use App\Services\MobilService;
use App\Services\MotorService;
use Illuminate\Http\Response;
use MongoDB\Model\BSONDocument as BSONDocument;
use MongoDB\Model\BSONArray;

class KendaraanController extends Controller
{   

    protected $kendaraanService, $motorService, $mobilService, $user;

    public function __construct(KendaraanService $kendaraanService, MobilService $mobilService, MotorService $motorService)
    {
        
        $this->kendaraanService = $kendaraanService;
        $this->mobilService = $mobilService;
        $this->motorService = $motorService;
    }
    public function show(){
            $data = $this->kendaraanService->getAllKendaraan();
        
            if($data->count() < 0){
                return response()->json([
                    'success' => false,
                    'data' => $data
                ], Response::HTTP_OK);
            }
            
            return response()->json([
                'success' => true,
                'data' => $data
            ], Response::HTTP_OK);
    }
    public function findById($id){
            return response()->json([
                'success'=>true,
                'data' => $this->kendaraanService->findKendaraanById($id)
            ], Response::HTTP_OK);
    }


    public function store(Request $request){
        
            if($request->tipe_kendaraan == 'mobil'){
                $validatedData = $this->mobilService->validator($request);
            }else if($request->tipe_kendaraan == 'motor'){
                $validatedData = $this->motorService->validator($request);
            }else{
                return response()->json(['error'=>'Tipe kendaraan not valid'],Response::HTTP_BAD_REQUEST);
            }
    
            return response()->json([
                'success'=>true,
                'data' => $this->kendaraanService->store($validatedData)
            ], Response::HTTP_OK);
    }
    public function update($id, $data){

            $updated = $this->kendaraanService->update($id, $data);
            
            if($updated){
                return response()->json([
                    'success'=>true,
                    'message' => 'Data Kendaraan on ID: '.$id.' updated!',
                    'data' => $data
                ], Response::HTTP_OK);
            }else{
                return response()->json([
                    'success'=>false,
                    'message' => 'Data Kendaraan on ID: '.$id.' failed to update!'
                ], Response::HTTP_OK);
            }
        

    }
    public function delete($id){
            $deleted = $this->kendaraanService->deleteKendaraanById($id);
            if($deleted > 0){
                return response()->json([
                    'success'=>true,
                    'message' => 'Data Kendaraan on ID: '.$id,
                    'credentials' => $deleted
                ], Response::HTTP_OK);
            }else{
                return response()->json([
                    'success'=>false,
                    'message' => 'Data Kendaraan on ID: '.$id.' failed to delete!',
                    'credentials' => $deleted
                ], Response::HTTP_OK);
            }
    }

    public function showPenjualan(){
        $penjualan = $this->kendaraanService->getAllPenjualan();
        if($penjualan->count() < 0){
            return response()->json([
                'success' => false,
                'data' => $penjualan
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => true,
            'data' => $penjualan
        ], Response::HTTP_OK);

    }

}
