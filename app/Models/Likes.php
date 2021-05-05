<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    public $fillable = ['id_mod', 'user_id'];
}
