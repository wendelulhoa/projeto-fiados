<?php

namespace App\Http\Controllers;

use App\Models\CategoryMods;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return CategoryMods::all();
    }

    public function create(Request $request){
        try{
            CategoryMods::create([
                'name' => $request['name']
            ]);
        }catch(Exception $e){
            return $e;
        }
    }

    public function edit(Request $request){
        try{
            CategoryMods::where('id', '=', 1)->update(['name'=> 'wendel']);
        }catch(Exception $e){

        }
    }

    public function delete(){
        try{
            CategoryMods::where('id', '=', 1)->delete();
        }catch(Exception $e){

        }
    }
}
