<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\MotorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [ApiController::class, 'login']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware'=>'jwt.auth'], function(){
    
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('getUser', [ApiController::class, 'get_user']);
    
    //Route for kendaraan
    Route::get('show',[KendaraanController::class,'show']);
    Route::get('show/penjualan',[KendaraanController::class,'showPenjualan']);
    Route::post('store',[KendaraanController::class,'store']);
    Route::put('update/{id}',[KendaraanController::class,'update']);
    Route::delete('delete/{id}',[KendaraanController::class,'delete']);

    //Route for mobil
    Route::get('show/mobil',[MobilController::class,'showAllMobil']);
    Route::get('stock/mobil',[MobilController::class,'showStockMobil']);
    Route::get('penjualan/mobil',[MobilController::class,'showPenjualanMobil']);

    //Route for motor
    Route::get('show/motor',[MotorController::class,'showAllMotor']);
    Route::get('stock/motor',[MotorController::class,'showStockMotor']);
    Route::get('penjualan/motor',[MotorController::class,'showPenjualanMotor']);

});
