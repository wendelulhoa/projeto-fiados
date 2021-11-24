<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Notifications;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();

            $ids = explode(',', $request->ids) ?? [];
            if(count($ids) > 0){
                Notifications::whereIn('id',$ids)->update([
                    'active' => false
                ]);
            }

            DB::commit();
            return response(['success'], 200);
        }catch (Exception $e){
            DB::rollBack();

        }
    }

    /**
     * Notifica o cliente e os admin quando realiza um pagamento. 
     *
     * @param integer $userId
     * @param float $amount
     * @return void
     */
    public static function notifyAdminAndClientPayment($userId, $amount) {
        $admins = User::getAllAdmins();
        $client = Clients::getClient($userId);

        /* Notifica os administradores. */
        foreach($admins as $admin) {
            Notifications::create([
                'type'    => 'P',
                'title'   => 'Obrigado! pagamento realizado de R$: ' . moneyConvert($amount),
                'message' => View('layouts.templates-notifications.template-notification-payment', ['amount'=>$amount, 'client' => $client])->render(),
                'link'    => '',
                'user_id' => $admin->id,
                'active'  => true,
            ]); 
        }

        /* Notifica o cliente.*/
        Notifications::create([
            'type'    => 'P',
            'title'   => 'Obrigado! pagamento realizado de R$: ' . moneyConvert($amount),
            'message' => View('layouts.templates-notifications.template-notification-payment', ['amount'=>$amount, 'client' => $client])->render(),
            'link'    => '',
            'user_id' => $userId,
            'active'  => true,
        ]); 


    }
}
