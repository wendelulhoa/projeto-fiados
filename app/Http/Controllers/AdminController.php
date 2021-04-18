<?php

namespace App\Http\Controllers;

use App\Models\Mods;
use App\Models\Tags;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
       try{
            $mods = Mods::paginate(2) ?? [];
            $tags = Tags::paginate(2) ?? [];
            return view('admin.index', compact('mods','tags'));
        }catch(Exception $e){

        }
    }

    public function listUsers(){
        $users = User::paginate(5);
        return view('admin.list-user', compact('users'));
    }
    public function getStrutureCreate(){
        return view('admin.create');
    }
}
