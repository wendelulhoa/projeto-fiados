<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeTotal extends Model
{
    public $fillable = ['id_mod','total'];
    protected $table = 'like_total';
}
