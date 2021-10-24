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
}
