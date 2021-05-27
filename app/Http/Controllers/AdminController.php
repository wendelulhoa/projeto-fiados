<?php

namespace App\Http\Controllers;

use App\Models\CategoryGames;
use App\Models\CategoryMods;
use App\Models\Mods;
use App\Models\Tags;
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
            $mods = Mods::where('approved', 'false')->paginate(6) ?? [];
            $tags = Tags::paginate(5) ?? [];

            return view('admin.index', compact('mods', 'tags'));
        } catch (Exception $e) {

        }
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
            if(Auth::user()->type_user == 0){
                $mods = Mods::where(['approved'=> true, 'user_id'=> Auth::user()->id])->paginate(6) ?? [];
            }else{
                $mods = Mods::where('approved', 'true')->paginate(6) ?? [];
            }

            return view('admin.approved', ['mods'=>$mods]);
        } catch (Exception $e) {
            abort(500);
        }
    }
    
    public function notApproved(){
        try {
            if(Auth::user()->type_user == 0){
                $mods = Mods::where(['approved'=> false, 'user_id'=> Auth::user()->id])->paginate(6) ?? [];
            }else{
                $mods = Mods::where(['approved'=> false])->paginate(6) ?? [];
            }

            return view('admin.not-approved', ['mods'=>$mods]);
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
