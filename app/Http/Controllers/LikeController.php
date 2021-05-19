<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\LikeTotal;
use App\Models\Mods;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function create(Request $request){
        try{
            DB::beginTransaction();
            $likesExists = Likes::where([
                                'id_mod'  => $request['id'], 
                                'user_id' => Auth::user()->id
                            ])->get();

            if(count($likesExists) == 0){
                $mod   = Mods::where('id', '=', $request['id']);
                $total = $mod->get()[0]->total_likes;
                $total = intval($total) + 1;
            
                Mods::where(['id'=> $request['id']])->update(['total_likes'=> $total]);   

                Likes::create([
                    'id_mod'  => $request['id'], 
                    'user_id' => Auth::user()->id
                ]);
            }else{
                return response(['error'=> 'like já foi inserido'], 400);
            }
            

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            return response(['error'=>$e], 400);
        }
    }

    public function delete(Request $request){
        try{
            $like = Likes::where(['user_id'=> Auth::user()->id, 'id_mod'=> $request['id']]);
            $likeUser = $like->get();
            
            if(count($likeUser) > 0){
                $like->delete();
                $likes = Mods::where(['id'=> $request['id']])->get();
                $total = $likes[0]->total_likes - 1;
                Mods::where('id', '=', $request['id'])->update(['total_likes'=> $total]); 
            }    
        }catch(Exception $e){
            return response(['error'=>$e], 400);
        }
    }
}
