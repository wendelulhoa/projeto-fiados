<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    public $fillable = ['date_payment', 'day', 'month','year', 'amount', 'user_id', 'active'];

    /**
     * Verifica se tem conta em aberto
     *
     * @param [type] $userId
     * @return void
     */
    protected static function paymentActive($userId) {
        return Payments::where(['user_id'=> $userId, 'active'=> true])->first();
    }

    protected static function openPayments() {
        return Payments::select('payments.*', 'users.name', 'clients.cpf')
        ->join('clients', 'payments.user_id','=', 'clients.user_id')
        ->join('users', 'payments.user_id','=', 'users.id')
        ->where(['payments.active'=> true])->paginate(10);
    }

    protected static function closedPayments() {
        return Payments::select('payments.*', 'users.name', 'clients.cpf')
        ->join('clients', 'payments.user_id','=', 'clients.user_id')
        ->join('users', 'payments.user_id','=', 'users.id')
        ->where(['payments.active'=> false])->paginate(10);
    }
}
