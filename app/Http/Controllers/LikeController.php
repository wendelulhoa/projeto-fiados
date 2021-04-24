<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function create(){
        try{

        }catch(Exception $e){
            return response(['error'=>$e], 400);
        }
    }

    public function edit(){
        try{
            
        }catch(Exception $e){
            return response(['error'=>$e], 400);
        }
    }
}
