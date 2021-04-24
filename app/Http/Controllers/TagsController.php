<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class TagsController extends Controller
{
    public function index(){
        try{
            $tags = Tags::all() ?? [];
            return view('tags.index', compact('tags'));
        }catch(Exception $e){

        }
        
    }

    public function create(Request $request){
        try{
            Tags::create([
                'name' => $request['tag']
            ]);
        }catch(Exception $e){
            return $e;
        }
    }
    
    public function getStrutureTag($id){
        try{
           $tags     = Tags::where(['id'=> $id])->get();
           $category = [];
           $route    = Route('tags-edit', [$id]);
           return view('admin.create', compact('category', 'tags', 'route'));
        }catch(Exception $e){

        }

    }

    public function edit($id, Request $request){
        try{
            Tags::where('id', '=', $id)->update(['name'=> $request['tag']]);
        }catch(Exception $e){

        }
    }

    public function delete($id){
        try{
            Tags::where('id', '=', $id)->delete();
        }catch(Exception $e){

        }
    }
}
