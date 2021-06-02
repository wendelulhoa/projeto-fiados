<?php

namespace App\Http\Controllers;

use App\Models\ets2;
use App\Models\games;
use App\Models\Mods;
use Exception;
use Illuminate\Http\Request;

class Ets2Controller extends Controller
{
    public function index(){
        try{
            $categoryGame = games::getCategoriesGames();
            $categoryMod  = games::getCategoriesPt();
            $categoriesModsEn = games::getCategoriesEn();
            $keyCategories= ets2::getCategoriesKeys();
            $routesNames  = games::getRouteGame();

            $mods = Mods::where(['category_game' => 2, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'Ets2', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod, 'keyCategories'=> $keyCategories, 'categoriesModsEn'=>$categoriesModsEn, 'routesNames'=> $routesNames, 'game'=>2]);
        }catch(Exception $e){

        }
    }

    public function search($category, $tag = ''){
        $categoryGame = games::getCategoriesGames();
        $categoryMod  = games::getCategoriesPt();
        $categoriesModsEn = games::getCategoriesEn();
        $routesNames  = games::getRouteGame();
        $indexCategory = ets2::getCategoryIndex($category) ?? 0;
        $tags   = ets2::getTags($indexCategory);
        $tagsEn = ets2::getTagsEn($indexCategory);
        $keyCategories= ets2::getCategoriesKeys();
       
        if($tag == ""){
            $mods = Mods::where(['category_game' => 2, 'category'=> $indexCategory, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'Ets2', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod,
                        'routesNames'=>$routesNames, 'categoriesModsEn'=>$categoriesModsEn, 'tags'=> $tags, 
                        'tagEn'=>$tagsEn, 'game'=>2, 'category'=>$indexCategory]);
        }else{
            
            $indexCategory = ets2::getCategoryIndex($category) ?? 0;
            $mods = Mods::where(['category_game' => 2, 'category'=> $indexCategory, 'tagEn'=> $tag, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'Ets2', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod,
                        'routesNames'=>$routesNames, 'categoriesModsEn'=>$categoriesModsEn, 'tags'=> $tags, 'tagEn'=>$tagsEn,
                        'game'=>2, 'category'=>$indexCategory, 'tagSelected'=> $tag]);
        }
    }

    public static function getCategories(){
        try{
            $categoriesets2 = ets2::getCategoriesKeys();
            $categories     = games::getCategoriesPt();
            $categoriesFinal= [];
            
            foreach($categoriesets2 as $item){
                $categoriesFinal[] = ['category'=>$categories[$item], 'key'=> $item];   
            }

            return response($categoriesFinal, 200);
        }catch(Exception $e){

        }
    }
    
    public static function getTags($category){
        try{
            $tags   = ets2::getTags($category);
            $tagsEn = ets2::getTagsEn($category);
            $tagsFinal = [];
            
            foreach($tagsEn as $key => $item){
                $tagsFinal[] = ['tag'=>$tags[$key], 'key'=> $tags[$key].'-'.$item];   
            }

            return response($tagsFinal, 200);
        }catch(Exception $e){

        }
    }
}
