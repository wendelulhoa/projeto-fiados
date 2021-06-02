<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Notifications;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            Comments::create([
                'id_mod'  => $request['id'],
                'message' => $request['message'],
                'user_id' => Auth::user()->id,
            ]);
            if (intval($request['user']) != intval(Auth::user()->id)) {
                Notifications::create([
                    'type'    => 'C',
                    'title'   => Auth::user()->name . ' comentou no seu mod',
                    'message' => $request['message'],
                    'link'    => '',
                    'user_id' => $request['user'],
                    'id_mod'  => $request['id'],
                    'active'  => true,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response(['error' => $e], 400);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            Comments::where('id', '=', $id)->update(['message' => $request['comment'] ?? 'wendel']);
        } catch (Exception $e) {
            return response(['error' => $e], 400);
        }
    }

    public function delete($user_id, $id, $id_mod){
        try{
            DB::beginTransaction();
              if(Auth::check()){
                Comments::where(['user_id'=> $user_id, 'id'=> $id, 'id_mod'=> $id_mod])->delete();
              }
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return response(['error'=>$e], 400);
        }
    }
}
