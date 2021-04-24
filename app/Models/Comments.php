<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public $fillable = ['id_mod','message', 'user_id'];
}
