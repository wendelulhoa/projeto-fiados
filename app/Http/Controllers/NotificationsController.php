<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function getNotification(){
        try{
            if(Auth::check()){
               $notifications = Notifications::where(['user_id' => Auth::user()->id])->get();
                return response($notifications, 200);
            }else{
                return response(['error'=> 'usuario não autenticado'], 400);
            }
            
        }catch(Exception $e){
            return response(['error'=> $e], 400);
        }
    }
}
