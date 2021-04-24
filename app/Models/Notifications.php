<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    public $fillable = ['type','message', 'active', 'link', 'user_id'];
}
