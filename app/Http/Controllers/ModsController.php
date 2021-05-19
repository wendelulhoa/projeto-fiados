<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Likes;
use App\Models\LikeTotal;
use App\Models\Mods;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModsController extends Controller
{
    public function index(Request $request){
       try{
            if(isset($request->param)){
                $request->param = strtoupper($request->param);
                $mods = Mods::where([['name', 'like','_'.$request->param.'%']])->orWhere([['description', 'like','%'.$request->param.'%']])->paginate(9) ?? [];
            }else{
                $mods = DB::table('mods')->paginate(9) ?? [];
           }
            
            return view('mods.mods', compact('mods'));
        }catch(Exception $e){

        }
    }

    public function create(Request $request){
        try{
            $data         = $request->all();
            $imagesDelete = [];
            $path         = [];
            

            if (isset($request['files'])){
               foreach($data['files'] as $key => $value){
                    $imagePath      = $value->store('mods/images');
                    $path[]         = ['path'=> $imagePath]; 
                    $imagesDelete[] = $imagePath;
               } 
            } else{
                $path =[];
            }
            DB::beginTransaction();
            if($path != []){
                Mods::create([
                    'name'       => $request['name'],
                    'description'=> $request['description'],
                    'images'     => json_encode($path),
                    'approved'   => false,
                    'tags'       => $request['tag'],
                    'link'       => $request['link'],
                    'category'   => $request['category'],
                    'user_id'    => Auth::user()->id,
                    'total_likes'=> 0
                ]);
            }else{
                Storage::delete($imagesDelete);
                return response(['error'=>'path vazio'], 400);
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            Storage::delete($imagesDelete);
            return response(['error'=> $e], 400);
        }
    }

    public function imageStorage(Request $request){
        $data = $request->all();
        dd($request['imgs']);
        if (isset($request['files'])){
            foreach($data['files'] as $key => $value){
                $imagePath      = $value->store('mods/images');
                $path[]         = ['path'=> $imagePath]; 
                $imagesDelete[] = $imagePath;
            } 
        } else{
            $path =[];
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
            $user     = $mod[0]->user_id ?? 0;
            $comments = Comments::where(['id_mod'=> $id])
                        ->join('users', 'comments.user_id', 'users.id')
                         ->select('users.name', 'comments.*')
                         ->orderBy('comments.id')->get();
            $likeSelect = false;
            $totalLikes = $mod[0]->total_likes ?? 0;

            if(Auth::check()){
               $likeSelect = count(Likes::where(['user_id'=> Auth::user()->id, 'id_mod'=> $id])->get()) > 0 ? true : false; 
            }           
            return view('mods.detail', compact('mod', 'id', 'comments', 'user', 'likeSelect', 'totalLikes'));
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
