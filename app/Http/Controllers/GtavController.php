<?php

namespace App\Http\Controllers;

use App\Models\CategoryGames;
use App\Models\games;
use App\Models\gtav;
use App\Models\Mods;
use Exception;
use Illuminate\Http\Request;

class GtavController extends Controller
{
    public function index(){
        try{
            $categoryGame = games::getCategoriesGames();
            $categoryMod  = games::getCategoriesPt();
            $categoriesModsEn = games::getCategoriesEn();
            $keyCategories= gtav::getCategoriesKeys();
            $routesNames  = games::getRouteGame();

            $mods = Mods::where(['category_game' => 0, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA V', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod, 'keyCategories'=> $keyCategories, 'categoriesModsEn'=>$categoriesModsEn, 'routesNames'=> $routesNames, 'game'=>0]);
        }catch(Exception $e){

        }
    }

    public function search($category, $tag = ''){
        $categoryGame = games::getCategoriesGames();
        $categoryMod  = games::getCategoriesPt();
        $categoriesModsEn = games::getCategoriesEn();
        $routesNames  = games::getRouteGame();
        $indexCategory = gtav::getCategoryIndex($category) ?? 0;
        $tags   = gtav::getTags($indexCategory);
        $tagsEn = gtav::getTagsEn($indexCategory);
        $keyCategories= gtav::getCategoriesKeys();
       
        if($tag == ""){
            $mods = Mods::where(['category_game' => 0, 'category'=> $indexCategory, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA V', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod,
                        'routesNames'=>$routesNames, 'categoriesModsEn'=>$categoriesModsEn, 'tags'=> $tags, 
                        'tagEn'=>$tagsEn, 'game'=>0, 'category'=>$indexCategory]);
        }else{
            
            $indexCategory = gtav::getCategoryIndex($category) ?? 0;
            $mods = Mods::where(['category_game' => 0, 'category'=> $indexCategory, 'tagEn'=> $tag, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA V', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod,
                        'routesNames'=>$routesNames, 'categoriesModsEn'=>$categoriesModsEn, 'tags'=> $tags, 'tagEn'=>$tagsEn,
                        'game'=>0, 'category'=>$indexCategory, 'tagSelected'=> $tag]);
        }
    }

    public static function getCategories(){
        try{
            $categoriesGtav = gtav::getCategoriesKeys();
            $categories     = games::getCategoriesPt();
            $categoriesFinal= [];
            
            foreach($categoriesGtav as $item){
                $categoriesFinal[] = ['category'=>$categories[$item], 'key'=> $item];   
            }

            return response($categoriesFinal, 200);
        }catch(Exception $e){

        }
    }
    
    public static function getTags($category){
        try{
            $tags   = gtav::getTags($category);
            $tagsEn = gtav::getTagsEn($category);
            $tagsFinal = [];
            
            foreach($tagsEn as $key => $item){
                $tagsFinal[] = ['tag'=>$tags[$key], 'key'=> $tags[$key].'-'.$item];   
            }

            return response($tagsFinal, 200);
        }catch(Exception $e){

        }
    }

}
