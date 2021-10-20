<?php

namespace App\Http\Controllers;

use App\Models\CategoryGames;
use App\Models\CategoryMods;
use App\Models\Mods;
use App\Models\Posts;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    public function index()
    {
        try {
            return view('admin.index');
        } catch (Exception $e) {
            
        }
    }

    public function approved(){
        try {
            $categories = Posts::getCategories();
            if(Auth::user()->type_user == 0){
                $posts = Posts::orderBy('id','asc')->where(['approved'=> true, 'user_id'=> Auth::user()->id])->paginate(6) ?? [];
            }else{
                $posts = Posts::orderBy('id','asc')->where('approved', 'true')->paginate(6) ?? [];
            }
            
            return view('admin.approved', ['posts'=>$posts, 'categories'=> $categories]);
        } catch (Exception $e) {
            abort(500);
        }
    }
    
    public function notApproved(){
        try {
            $categories = Posts::getCategories();
            if(Auth::user()->type_user == 0){
                $posts = Posts::orderBy('id','asc')->where(['approved'=> false, 'user_id'=> Auth::user()->id])->paginate(6) ?? [];
            }else{
                $posts = Posts::orderBy('id','asc')->where('approved', 'false')->paginate(6) ?? [];
            }
            
            return view('admin.approved', ['posts'=>$posts, 'categories'=> $categories]);
        } catch (Exception $e) {
            abort(500);
        }
    }

    public function waterMark(Request $request){
        try{
            if(isset($request->logo)){
                Storage::delete('logo-img/logo.png');
                // returns \Intervention\Image\Image - OK
                $logo = Image::make($request['logo'])
                                ->resize(512, null, function ($constraint) { $constraint->aspectRatio(); } )
                                ->encode('png', 70);
            
                // use hash as a name
                $principalImage = "logo-img/logo.png";

                Storage::put($principalImage, $logo);
            }
            return view('admin.water-mark');
        }catch(Exception $e){
            return view('admin.water-mark');
        }
    }
}
