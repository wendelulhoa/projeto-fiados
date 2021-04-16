<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mods extends Model
{
    public $fillable = ['name', 'description', 'images', 'approved', 'tags' , 'category'];
}
