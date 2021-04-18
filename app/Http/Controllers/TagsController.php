<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Exception;
use Illuminate\Http\Request;

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

    public function edit(Request $request){
        try{
            Tags::where('id', '=', 1)->update(['name'=> 'wendel']);
        }catch(Exception $e){

        }
    }

    public function delete(){
        try{
            Tags::where('id', '=', 1)->delete();
        }catch(Exception $e){

        }
    }
}
