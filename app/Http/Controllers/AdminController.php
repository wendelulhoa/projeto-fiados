<?php

namespace App\Http\Controllers;

use App\Models\CategoryGames;
use App\Models\CategoryMods;
use App\Models\Mods;
use App\Models\Tags;
use App\Models\User;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $mods = Mods::where('approved', 'false')->paginate(6) ?? [];
            $tags = Tags::paginate(5) ?? [];

            return view('admin.index', compact('mods', 'tags'));
        } catch (Exception $e) {

        }
    }

    public function listUsers()
    {
        $users = User::paginate(5);
        return view('admin.list-user', compact('users'));
    }

    public function getStrutureCreate()
    {
        try {
            return view('admin.create');
        } catch (Exception $e) {

        }
    }

    public function getCategoryAndTag()
    {
        try {
            
            $category     = CategoryMods::all();
            $categoryGame = CategoryGames::all();
            $tags         = Tags::all();

            return ['category' => $category, 'tags' => $tags, 'categoryGame'=> $categoryGame];
        } catch (Exception $e) {

        }
    }

    public function approved(){
        try {
            $mods = Mods::where('approved', 'true')->paginate(6) ?? [];

            return view('admin.approved', ['mods'=>$mods]);
        } catch (Exception $e) {

        }
    }
}
