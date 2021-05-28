<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index(){
        try{
            $notifications = Notifications::orderBy('id','desc')->where(['user_id' => Auth::user()->id])->paginate(5);
            
            return view('user.notify', ['notifications'=> $notifications]);
        }catch(Exception $e){

        }
    }
    public function getNotification(){
        try{
            if(Auth::check()){
                $notifications = Notifications::where(['user_id' => Auth::user()->id, 'active'=> true])->paginate(4);
                
                return response($notifications, 200);
            }else{
                return response(['error'=> 'usuario não autenticado'], 400);
            }
            
        }catch(Exception $e){
            return response(['error'=> $e], 400);
        }
    }

    public function disable(Request $request){
        try{
            $ids = explode(',', $request->ids) ?? [];
            if(count($ids) > 0){
                Notifications::whereIn('id',$ids)->update([
                    'active' => false
                ]);
            }

            return response(['success'], 200);
        }catch (Exception $e){

        }
    }
}
