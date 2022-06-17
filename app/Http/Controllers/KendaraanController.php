<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class KendaraanController extends Controller
{   

    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    public function show(){
        
    }
    public function store(){

    }
    public function update(){

    }
    public function destroy(){

    }

}
