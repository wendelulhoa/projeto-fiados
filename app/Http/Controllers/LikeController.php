<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\LikeTotal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function create(Request $request){
        try{
            DB::beginTransaction();
            
            $likes = LikeTotal::where(['id_mod'=> $request['id']])->get()->first() ?? [];
            if(empty($likes)){
                $total = 1;
                LikeTotal::create([
                    'id_mod' => $request['id'],
                    'total'  => $total
                ]);
            }else{
                $likes = LikeTotal::where(['id_mod'=> $request['id']])->get();
                $total = $likes[0]->total + 1; 

                LikeTotal::where('id_mod', '=', $request['id'])->update(['total'=> $total]);             
            }

            Likes::create([
                'id_mod'  => $request['id'], 
                'user_id' => Auth::user()->id
            ]);

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
                $likes = LikeTotal::where(['id_mod'=> $request['id']])->get();
                $total = $likes[0]->total - 1;
                LikeTotal::where('id_mod', '=', $request['id'])->update(['total'=> $total]); 
            }    
        }catch(Exception $e){
            return response(['error'=>$e], 400);
        }
    }
}
