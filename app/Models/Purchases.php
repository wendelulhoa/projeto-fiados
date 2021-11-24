<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    public $fillable = ['day', 'month','year', 'amount', 'user_id', 'func_id', 'payment_id'];

    /* Pega as compras de um id de pagamento*/ 
    protected static function getPurchases($paymentId) {
       return Purchases::where(['payment_id'=> $paymentId])->orderBy('id', 'DESC')->get();
    }

    /* Pega as compras de um id de pagamento*/ 
    protected static function getAllPurchases($id = null, $month, $year, $isPaginate = true) {
      if($id != null) {
         if($isPaginate) {
            return Purchases::select('purchases.*', 'users.name', 'clients.cpf')->
                  join('clients', 'purchases.user_id','=', 'clients.user_id')->
                  join('users', 'purchases.user_id','=', 'users.id')->
                  where(['purchases.month'=> $month,'purchases.year' => $year, 'purchases.user_id'=> $id])->orderBy('id', 'DESC')->paginate(6);
         } else {
            return Purchases::select('purchases.*', 'users.name', 'clients.cpf')->
                  join('clients', 'purchases.user_id','=', 'clients.user_id')->
                  join('users', 'purchases.user_id','=', 'users.id')->
                  where(['purchases.month'=> $month,'purchases.year' => $year, 'purchases.user_id'=> $id])->orderBy('id', 'DESC')->get();        
         }
      } else {
         if($isPaginate) {
            return Purchases::select('purchases.*', 'users.name', 'clients.cpf')->
                  join('clients', 'purchases.user_id','=', 'clients.user_id')->
                  join('users', 'purchases.user_id','=', 'users.id')->
                  where(['month'=> $month,'year' => $year])->orderBy('id', 'DESC')->paginate(6);
         } else {
            return Purchases::select('purchases.*', 'users.name', 'clients.cpf')->
                  join('clients', 'purchases.user_id','=', 'clients.user_id')->
                  join('users', 'purchases.user_id','=', 'users.id')->
                  where(['month'=> $month,'year' => $year])->orderBy('id', 'DESC')->get();      
         }
      }
    }
}
