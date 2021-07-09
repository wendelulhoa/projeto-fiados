<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public $fillable = ['title', 'author', 'image_principal', 'content', 'user_id', 'category', 'approved'];
    public $table = 'posts';

    public static function getCategories(){
        $categories = ['saude', 'tecnologia', 'relacionamento', 'direitos-e-leis', 'noticias', 'filmes', 'desenhos', 'animes', 'series', 'outros'];
        return $categories;
    }   
    
    public static function getCategoriesPt(){
        $categories = ['saúde', 'tecnologia', 'relacionamento', 'direitos e leis', 'notícias', 'filmes', 'desenhos', 'animes', 'séries', 'outros'];
        return $categories;
    }   
}
