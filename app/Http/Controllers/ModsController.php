<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Mods;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            
            if($path != ''){
                Mods::create([
                    'name'       => $request['name'],
                    'description'=> $request['description'],
                    'images'     => json_encode([['path'=>$path]]),
                    'approved'   => false,
                    'tags'       => $request['tag'],
                    'link'       => $request['link'],
                    'category'   => $request['category'],
                    'user_id'    => Auth::user()->id
                ]);
            }else{
                Storage::delete($path);
                return response(['error'=>'path vazio'], 400);
            }
            
        }catch(Exception $e){
            Storage::delete($path);
            return response(['error'=> $e], 400);
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
            $mod      = Mods::where('id', $id)->get();
            $comments = Comments::where(['id_mod'=> $id])
                        ->join('users', 'comments.user_id', 'users.id')
                         ->select('users.name', 'comments.*')->get(); 
            return view('mods.detail', compact('mod', 'id', 'comments'));
        }catch(Exception $e){
            return response(['error'=>$e], 500);
        }
        
    }

    public function delete(){
        try{
            Mods::where('id', '=', 1)->delete();
        }catch(Exception $e){

        }
    }
}
