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
    public function index(){
       try{
            $mods = DB::table('mods')
            ->leftJoin('like_total', 'mods.id','=', 'like_total.id_mod')->select('mods.*', 'like_total.total')->paginate(9) ?? [];
            // $table2 = DB::table('t2')
            //         ->rightJoin('t1', 't1.id', '=', 't2.t1_id');

            // $table1 = DB::table('mods')
            //         ->leftJoin('like_total', 'mods.id', '=', 'id_mod')
            //         ->unionAll($table2)
            //         ->get();
            // dd($mods);
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
            
            if($path != []){
                Mods::create([
                    'name'       => $request['name'],
                    'description'=> $request['description'],
                    'images'     => json_encode($path),
                    'approved'   => false,
                    'tags'       => $request['tag'],
                    'link'       => $request['link'],
                    'category'   => $request['category'],
                    'user_id'    => Auth::user()->id
                ]);
            }else{
                Storage::delete($imagesDelete);
                return response(['error'=>'path vazio'], 400);
            }
            
        }catch(Exception $e){
            Storage::delete($imagesDelete);
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
            $user     = $mod[0]->user_id ?? 0;
            $comments = Comments::where(['id_mod'=> $id])
                        ->join('users', 'comments.user_id', 'users.id')
                         ->select('users.name', 'comments.*')
                         ->orderBy('comments.id')->get();
            $likeSelect = false;
            $totalLikes = LikeTotal::where(['id_mod'=> $id])->get() ?? [];

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
