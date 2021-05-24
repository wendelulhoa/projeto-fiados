<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mods extends Model
{
    public $fillable = ['name', 'description', 'images', 'approved', 'tags' , 'category', 'link', 'user_id', 'total_likes', 'total_stars', 'total_users_stars', 'category_game', 'principal_image'];
}
