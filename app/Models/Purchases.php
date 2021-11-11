<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    public $fillable = ['day', 'month','year', 'amount', 'user_id', 'payment_id'];

    /* Pega as compras de um id de pagamento*/ 
    protected static function getPurchases($paymentId) {
       return Purchases::where(['payment_id'=> $paymentId])->orderBy('id', 'DESC')->get();
    }

    /* Pega as compras de um id de pagamento*/ 
    protected static function getAllPurchases($month, $year) {
       return Purchases::select('purchases.*', 'users.name', 'clients.cpf')->
                join('clients', 'purchases.user_id','=', 'clients.user_id')->
                join('users', 'purchases.user_id','=', 'users.id')->
                where(['month'=> $month,'year' => $year])->orderBy('id', 'DESC')->paginate(6);
    }
}
