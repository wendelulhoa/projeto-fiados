<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    public $fillable = ['date_payment', 'day', 'month','year', 'amount', 'user_id', 'func_id', 'active'];

    /**
     * Verifica se tem conta em aberto
     *
     * @param [type] $userId
     * @return void
     */
    protected static function paymentActive($userId) {
        return Payments::where(['user_id'=> $userId, 'active'=> true])->first();
    }

    /**
     * Retorna em paginate pagamentos abertos de um cliente ou de todos.
     *
     * @param integer $id
     * @param integer $month
     * @param integer $year
     * @return void
     */
    protected static function openPayments($id = null, $month, $year, $paginate = 10) {
        if($id !== null) {
            /* faz o where. */ 
            if(!empty($year)){
                $where = ['payments.active'=> true, 'payments.user_id'=> $id, 'payments.month'=> $month,'payments.year' => $year];
            } else {
                $where = ['payments.active'=> true, 'payments.user_id'=> $id];
            }

            return Payments::select('payments.*', 'users.name', 'clients.cpf')
            ->join('clients', 'payments.user_id','=', 'clients.user_id')
            ->join('users', 'payments.user_id','=', 'users.id')
            ->where($where)->orderBy('id', 'DESC')->paginate($paginate);
        } else {

            /* faz o where. */ 
            if(!empty($year)){
                $where = ['payments.active'=> true, 'payments.month'=> $month,'payments.year' => $year];
            } else {
                $where = ['payments.active'=> true];
            }

            return Payments::select('payments.*', 'users.name', 'clients.cpf')
            ->join('clients', 'payments.user_id','=', 'clients.user_id')
            ->join('users', 'payments.user_id','=', 'users.id')
            ->where($where)->orderBy('id', 'DESC')->paginate($paginate);
        }
    }

    /**
     * Retorna em paginate pagamentos abertos de um cliente ou de todos.
     *
     * @param integer $id
     * @param integer $month
     * @param integer $year
     * @return void
     */
    protected static function closedPayments($id = null, $month, $year, $paginate = 10) {
        if($id !== null) {
            
            /* faz o where. */ 
            if(!empty($year)){
                $where = ['payments.active'=> false, 'payments.user_id'=> $id, 'payments.month'=> $month,'payments.year' => $year];
            } else {
                $where = ['payments.active'=> false, 'payments.user_id'=> $id];
            }

            return Payments::select('payments.*', 'users.name', 'clients.cpf')
                ->join('clients', 'payments.user_id','=', 'clients.user_id')
                ->join('users', 'payments.user_id','=', 'users.id')
                ->where($where)->orderBy('id', 'DESC')->paginate($paginate);
        } else {
            /* faz o where. */ 
            if(!empty($year)){
                $where = ['payments.active'=> false, 'payments.month'=> $month,'payments.year' => $year];
            } else {
                $where = ['payments.active'=> false];
            }

            return Payments::select('payments.*', 'users.name', 'clients.cpf')
                ->join('clients', 'payments.user_id','=', 'clients.user_id')
                ->join('users', 'payments.user_id','=', 'users.id')
                ->where($where)->orderBy('id', 'DESC')->paginate($paginate);
        }
    }
  
    /**
     * Pega Todos os pagamentos abertos de um cliente ou de todos.
     *
     * @param integer $id
     * @param integer $month
     * @param integer $year
     * @return void
     */
    protected static function getAllOpenpayments($id = null, $month, $year) {
        /* faz o where. */ 
        /* faz o where. */ 
        if($id == null) {
            if(!empty($year)){
                $where = ['payments.active'=> true, 'payments.month'=> $month,'payments.year' => $year];
            } else {
                $where = ['payments.active'=> true];
            }
        } else {
            if(!empty($year)){
                $where = ['payments.active'=> true, 'payments.month'=> $month,'payments.year' => $year,  'payments.user_id'=> $id];
            } else {
                $where = ['payments.active'=> true,  'payments.user_id'=> $id];
            }
        }

        return Payments::select('payments.*', 'users.name', 'clients.cpf')
            ->join('clients', 'payments.user_id','=', 'clients.user_id')
            ->join('users', 'payments.user_id','=', 'users.id')
            ->where($where)->orderBy('id', 'DESC')->get();
    }

    /**
     * Pega Todos os pagamentos de um cliente ou de todos.
     *
     * @param integer $id
     * @param integer $month
     * @param integer $year
     * @return void
     */
    protected static function getAllClosedpayments($id = null, $month, $year) {
        /* faz o where. */ 
        if($id == null) {
            if(!empty($year)){
                $where = ['payments.active'=> false, 'payments.month'=> $month,'payments.year' => $year];
            } else {
                $where = ['payments.active'=> false];
            }
        } else {
            if(!empty($year)){
                $where = ['payments.active'=> false, 'payments.month'=> $month,'payments.year' => $year,  'payments.user_id'=> $id];
            } else {
                $where = ['payments.active'=> false,  'payments.user_id'=> $id];
            }
        }

        return Payments::select('payments.*', 'users.name', 'clients.cpf')
            ->join('clients', 'payments.user_id','=', 'clients.user_id')
            ->join('users', 'payments.user_id','=', 'users.id')
            ->where($where)->orderBy('id', 'DESC')->get();
    }
}
