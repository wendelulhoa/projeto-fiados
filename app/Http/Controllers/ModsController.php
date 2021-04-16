<?php

namespace App\Http\Controllers;

use App\Models\Mods;
use Exception;
use Illuminate\Http\Request;

class ModsController extends Controller
{
    public function index(){
       return Mods::all();
    }

    public function create(Request $request){
        try{
            Mods::create([
                'name'       => $request['name'],
                'description'=> $request['description'],
                'images'     => json_encode(["teste"]),
                'approved'   => false,
                'tags'       => json_encode([1,2,3]),
                'category'   => $request['category']
            ]);
        }catch(Exception $e){
            return $e;
        }
    }

    public function edit(Request $request){
        try{
            Mods::where('id', '=', 1)->update(['name'=> 'wendel']);
        }catch(Exception $e){

        }
    }

    public function delete(){
        try{
            Mods::where('id', '=', 1)->delete();
        }catch(Exception $e){

        }
    }
}
