<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    public $fillable = ['birth', 'cpf','user_id', 'limit'];

    /**
     * Pega todos os clientes
     *
     * @return object
     */
    protected static function getAllClients() {
        return Clients::select('clients.*', 'users.name')->join('users', 'clients.user_id', 'users.id')->get();
    }
    
    /**
     * Pega um cliente especifico
     *
     * @return object
     */
    protected static function getClient($id) {
        return Clients::where(['clients.user_id'=> $id])->select('clients.*', 'users.name', 'users.email')->join('users', 'clients.user_id', 'users.id')->get();
    }

    /**
     * pega o limite de um cliente
     *
     * @param integer $id
     * @return void
     */
    protected static function getLimit($id = null) {
        return moneyConvert(Clients::select('limit')->where(['user_id'=>$id])->get()[0]->limit ?? 0);
    }
    
    protected static function getTotalClients() {
        return clients::count();
    }


}
