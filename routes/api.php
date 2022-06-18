<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\KendaraanController;
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
    Route::get('showAll',[KendaraanController::class,'show']);
    Route::post('store',[KendaraanController::class,'store']);
    Route::put('update/{id}',[KendaraanController::class,'update']);
    Route::delete('delete/{id}',[KendaraanController::class,'delete']);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
