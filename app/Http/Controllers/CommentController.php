<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Notifications;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request){
        try{
            Comments::create([
                'id_mod' => $request['id'],
                'message'=> $request['message'],
                'user_id'=> Auth::user()->id
            ]);

            Notifications::create([
                'type'=> 'C',
                'message'=> Auth::user()->name . ' comentou no seu mod',
                'link'=> '', 
                'user_id'=> Auth::user()->id, 
                'active'=> true
            ]);
            
        }catch(Exception $e){
            return response(['error'=>$e], 400);
        }
    }

    public function edit($id){
        try{
            Comments::where('id', '=', $id)->update(['message'=> $request['comment'] ?? 'wendel']);
        }catch(Exception $e){
            return response(['error'=>$e], 400);
        }
    }
}
