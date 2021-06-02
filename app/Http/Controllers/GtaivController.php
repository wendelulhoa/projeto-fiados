<?php

namespace App\Http\Controllers;

use App\Models\games;
use App\Models\gtaiv;
use App\Models\Mods;
use Exception;
use Illuminate\Http\Request;

class GtaivController extends Controller
{
    public function index(){
        try{
            $categoryGame = games::getCategoriesGames();
            $categoryMod  = games::getCategoriesPt();
            $categoriesModsEn = games::getCategoriesEn();
            $keyCategories= gtaiv::getCategoriesKeys();
            $routesNames  = games::getRouteGame();

            $mods = Mods::where(['category_game' => 3, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA IV', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod, 'keyCategories'=> $keyCategories, 'categoriesModsEn'=>$categoriesModsEn, 'routesNames'=> $routesNames, 'game'=>3]);
        }catch(Exception $e){

        }
    }

    public function search($category, $tag = ''){
        $categoryGame = games::getCategoriesGames();
        $categoryMod  = games::getCategoriesPt();
        $categoriesModsEn = games::getCategoriesEn();
        $routesNames  = games::getRouteGame();
        $indexCategory = gtaiv::getCategoryIndex($category) ?? 0;
        $tags   = gtaiv::getTags($indexCategory);
        $tagsEn = gtaiv::getTagsEn($indexCategory);
        $keyCategories= gtaiv::getCategoriesKeys();
       
        if($tag == ""){
            $mods = Mods::where(['category_game' => 3, 'category'=> $indexCategory, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA IV', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod,
                        'routesNames'=>$routesNames, 'categoriesModsEn'=>$categoriesModsEn, 'tags'=> $tags, 
                        'tagEn'=>$tagsEn, 'game'=>3, 'category'=>$indexCategory]);
        }else{
            
            $indexCategory = gtaiv::getCategoryIndex($category) ?? 0;
            $mods = Mods::where(['category_game' => 3, 'category'=> $indexCategory, 'tagEn'=> $tag, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA IV', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod,
                        'routesNames'=>$routesNames, 'categoriesModsEn'=>$categoriesModsEn, 'tags'=> $tags, 'tagEn'=>$tagsEn,
                        'game'=>3, 'category'=>$indexCategory, 'tagSelected'=> $tag]);
        }
    }

    public static function getCategories(){
        try{
            $categoriesGtaiv = gtaiv::getCategoriesKeys();
            $categories     = games::getCategoriesPt();
            $categoriesFinal= [];
            
            foreach($categoriesGtaiv as $item){
                $categoriesFinal[] = ['category'=>$categories[$item], 'key'=> $item];   
            }

            return response($categoriesFinal, 200);
        }catch(Exception $e){

        }
    }
    
    public static function getTags($category){
        try{
            $tags   = gtaiv::getTags($category);
            $tagsEn = gtaiv::getTagsEn($category);
            $tagsFinal = [];
            
            foreach($tagsEn as $key => $item){
                $tagsFinal[] = ['tag'=>$tags[$key], 'key'=> $tags[$key].'-'.$item];   
            }

            return response($tagsFinal, 200);
        }catch(Exception $e){

        }
    }
}
