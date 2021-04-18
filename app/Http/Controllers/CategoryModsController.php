<?php

namespace App\Http\Controllers;

use App\Models\CategoryMods;
use Exception;
use Illuminate\Http\Request;

class CategoryModsController extends Controller
{
    public function index(){
        try{
            $category = CategoryMods::all() ?? [];
            return view('categorymods.index', compact('category'));
        }catch(Exception $e){

        }
    }

    public function create(Request $request){
        try{
            CategoryMods::create([
                'name' => $request['category']
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
