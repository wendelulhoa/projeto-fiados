<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mods extends Model
{
    public $fillable = ['name', 'description', 'images', 'approved', 'tagPt', 'tagEn' , 'category', 'link', 'user_id', 'total_likes', 'total_stars', 'total_users_stars', 'category_game', 'principal_image', 'total_downloads', 'release', 'link_video'];
}
