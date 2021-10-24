<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    public $fillable = ['day', 'month','year', 'amount', 'user_id', 'payment_id'];
}
