<?php

namespace App\Http\Controllers;

use App\Models\games;
use App\Models\gtasa;
use App\Models\Mods;
use Exception;
use Illuminate\Http\Request;

class GtasaController extends Controller
{
    public function index(){
        try{
            $categoryGame = games::getCategoriesGames();
            $categoryMod  = games::getCategoriesPt();
            $categoriesModsEn = games::getCategoriesEn();
            $keyCategories= gtasa::getCategoriesKeys();
            $routesNames  = games::getRouteGame();

            $mods = Mods::where(['category_game' => 1, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA SA', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod, 'keyCategories'=> $keyCategories, 'categoriesModsEn'=>$categoriesModsEn, 'routesNames'=> $routesNames, 'game'=>1]);
        }catch(Exception $e){

        }
    }

    public function search($category, $tag = ''){
        $categoryGame = games::getCategoriesGames();
        $categoryMod  = games::getCategoriesPt();
        $categoriesModsEn = games::getCategoriesEn();
        $routesNames  = games::getRouteGame();
        $indexCategory = gtasa::getCategoryIndex($category) ?? 0;
        $tags   = gtasa::getTags($indexCategory);
        $tagsEn = gtasa::getTagsEn($indexCategory);
        $keyCategories= gtasa::getCategoriesKeys();
       
        if($tag == ""){
            $mods = Mods::where(['category_game' => 1, 'category'=> $indexCategory, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA SA', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod,
                        'routesNames'=>$routesNames, 'categoriesModsEn'=>$categoriesModsEn, 'tags'=> $tags, 
                        'tagEn'=>$tagsEn, 'game'=>1, 'category'=>$indexCategory]);
        }else{
            $indexCategory = gtasa::getCategoryIndex($category) ?? 0;
            $mods = Mods::where(['category_game' => 1, 'category'=> $indexCategory, 'tagEn'=> $tag, 'approved'=> true])->paginate(9);

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA SA', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod,
                        'routesNames'=>$routesNames, 'categoriesModsEn'=>$categoriesModsEn, 'tags'=> $tags, 'tagEn'=>$tagsEn,
                        'game'=>1, 'category'=>$indexCategory, 'tagSelected'=> $tag]);
        }
    }

    public static function getCategories(){
        try{
            $categoriesGtasagtasa = gtasa::getCategoriesKeys();
            $categories     = games::getCategoriesPt();
            $categoriesFinal= [];
            
            foreach($categoriesGtasagtasa as $item){
                $categoriesFinal[] = ['category'=>$categories[$item], 'key'=> $item];   
            }

            return response($categoriesFinal, 200);
        }catch(Exception $e){

        }
    }
    
    public static function getTags($category){
        try{
            $tags   = gtasa::getTags($category);
            $tagsEn = gtasa::getTagsEn($category);
            $tagsFinal = [];
            
            foreach($tagsEn as $key => $item){
                $tagsFinal[] = ['tag'=>$tags[$key], 'key'=> $tags[$key].'-'.$item];   
            }

            return response($tagsFinal, 200);
        }catch(Exception $e){

        }
    }
}
