<?php

namespace App\Http\Controllers;

use App\Models\Mods;
use Exception;
use Illuminate\Http\Request;

class ModsController extends Controller
{
    public function index(){
       try{
            $mods = Mods::all() ?? [];
            return view('mods.mods', compact('mods'));
        }catch(Exception $e){

        }
    }

    public function create(Request $request){
        try{
            if (isset($request['file'])){
                $path = $request->file->store('mods/images');
            } else{
                $path ='';
            }

            Mods::create([
                'name'       => $request['name'],
                'description'=> $request['description'],
                'images'     => json_encode([['path'=>$path]]),
                'approved'   => false,
                'tags'       => $request['tag'],
                'category'   => $request['category']
            ]);
        }catch(Exception $e){
            dd($e);
        }
    }

    public function edit(Request $request){
        try{
            Mods::where('id', '=', 1)->update(['name'=> 'wendel']);
        }catch(Exception $e){

        }
    }

    public function detail($id){
        try{
            $mod = Mods::where('id', $id)->get();
            return view('mods.detail', compact('mod'));
        }catch(Exception $e){
            return $e;
        }
        
    }

    public function delete(){
        try{
            Mods::where('id', '=', 1)->delete();
        }catch(Exception $e){

        }
    }
}
