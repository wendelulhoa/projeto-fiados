<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class games extends Model
{
    protected static function getCategoriesPt(){
        return ['veículos', 'caminhões', 'ônibus', 'armas', 'scripts', 'personagem', 'mapas', 'outros', 'ferramentas', 'construções', 'textura'];
    }
    
    protected static function getCategoriesEn(){
        return ['vehicles', 'trucks', 'buses', 'weapons', 'scripts', 'player', 'maps', 'others', 'tools', 'constructions', 'texture'];
    }

    protected static function getCategoriesGames(){
        return ['GTAV', 'GTASA', 'ETS2', 'GTAIV', 'MODELOS3D'];
    }
    
    protected static function getRouteGame(){
        return ['gtav', 'gtasa', 'ets2', 'gtaiv', 'models3d'];
    }
}
