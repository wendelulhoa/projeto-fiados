<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Mods;
use App\Models\Likes;
use App\Models\Stars;
use App\Models\Comments;
use App\Models\games;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ModsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $type         = 'Mods';
            $categoryGame = games::getCategoriesGames();
            $categoryMod  = games::getCategoriesPt();
            $routesNames  = games::getRouteGame();
            $categoriesModsEn = games::getCategoriesEn();

            if (isset($request->param)) {
                $request->param = strtoupper($request->param);
                $mods           = Mods::where([['name', 'ilike', '%' . $request->param . '%']])->orWhere([['description', 'ilike', '%' . $request->param . '%']])->paginate(9) ?? [];
            } else {
                $mods = DB::table('mods')->where('approved', '=', 'true')->paginate(9) ?? [];
            }

            return view('mods.mods', ['mods'=> $mods, 'type'=> 'GTA V', 'categoryGame' => $categoryGame, 'categoryMod'=> $categoryMod, 'routesNames'=>$routesNames, 'categoriesModsEn'=>$categoriesModsEn, 'type'=>$type]);
        } catch (Exception $e) {

        }
    }

    public function create(Request $request)
    {
        try {
            $data           = $request->all();
            $imagesDelete   = [];
            $principalImage = [];
        
            if (isset($request['principal-img'])) {
                $id = Auth()->user()->id;

                // returns \Intervention\Image\Image - OK
                $resize         = Image::make($request['principal-img'])
                                ->resize(512, null, function ($constraint) { $constraint->aspectRatio(); } )
                                ->encode('png', 70);
                
                // calculate md5 hash of encoded image
                $hash           = md5($resize->__toString());
                $rand           = rand(5, 20); 
                $extension      = $request['principal-img']->extension();
                
                // use hash as a name
                $principalImage = "images/mods-principal/{$id}-{$hash}{$rand}.{$extension}";

                Storage::put($principalImage, $resize);
            } else {
                $principalImage = [];
            }

            DB::beginTransaction();
            if ($principalImage != []) {
                $tag = explode('-', $request['tag']);
                $idMod = Mods::create([
                        'name'            => $request['name'],
                        'description'     => $request['description'],
                        'principal_image' => $principalImage,
                        'images'          => json_encode([]),
                        'approved'        => false,
                        'tagPt'           => $tag[0],
                        'tagEn'           => $tag[1],
                        'link'            => $request['link'],
                        'link_video'      => $request['link-video'],
                        'release'         => $request['release'],
                        'category_game'   => $request['category-game'],
                        'category'        => $request['category'],
                        'user_id'         => Auth::user()->id,
                        'total_likes'     => 0,
                        'total_stars'     => 0,
                        'total_users_stars'=> 0,
                        'total_downloads'=> 0
                ])->id;
            } else {
                Storage::delete($imagesDelete);
                DB::rollBack();
                return response(['error' => 'path vazio'], 400);
            }
            DB::commit();
            return response(['id' => $idMod], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Storage::delete($imagesDelete);
            return response(['error' => $e], 400);
        }
    }

    public function imageStorage(Request $request)
    {
        try{
            DB::beginTransaction();

            $data = $request->all();
            $query= Mods::where('id', '=', $request->id);
            $path = json_decode($query->get()[0]->images);
            $pathImage = [];

            
            if(!empty($path)){
                foreach($path as $value){
                   $pathImage[]= ['path'=>$value->path];
                }
                $secondary      = $request->file->store('mods/images');
                $pathImage[]    = ['path'=>$secondary];
            }else{
                $secondary      = $request->file->store('mods/images');
                $pathImage[]    = ['path'=>$secondary];
            }
            
            $imagesDelete[] = $secondary;

            $query->update(['images' => json_encode($pathImage)]);
            DB::commit();
            return response(['success'=> true], 200);
        }catch(Exception $e){
            DB::rollBack();
            Storage::delete($imagesDelete);
            return response(['error'=> true], 400);
        }
    }

    public function getStrutureEdit($id)
    {
        try {
            $mod      = Mods::where(['id'=> $id, 'user_id'=> Auth::user()->id])->get();
            $categoriesGames = games::getCategoriesGames();
            $categories      = games::getCategoriesPt();
            if(count($mod) == 0){
               return redirect(Route('index'));
            }
            return view('mods.edit', ['mod'=> $mod, 'categoriesGames'=> $categoriesGames]);
        } catch (Exception $e) {

        }
    }
    
    public function getStrutureCreate()
    {
        try {
            $categoriesGames = games::getCategoriesGames();
            $categories      = games::getCategoriesPt();

            return view('mods.create-struture', ['categoriesGames'=> $categoriesGames, 'categories'=> $categories]);
        } catch (Exception $e) {

        }
    }

    public function edit($id, Request $request)
    {
        try {
            $data           = $request->all();
            $imagesDelete   = [];
            $principalImage = [];
            // dd($request);
            // if (isset($request['principal-img'])) {
            //     $id = Auth()->user()->id;

            //     // returns \Intervention\Image\Image - OK
            //     $resize         = Image::make($request['principal-img'])
            //                     ->resize(512, null, function ($constraint) { $constraint->aspectRatio(); } )
            //                     ->encode('png', 70);
                
            //     // calculate md5 hash of encoded image
            //     $hash           = md5($resize->__toString());
            //     $rand           = rand(5, 20); 
            //     $extension      = $request['principal-img']->extension();
                
            //     // use hash as a name
            //     $principalImage = "images/mods-principal/{$id}-{$hash}{$rand}.{$extension}";

            //     Storage::put($principalImage, $resize);
            // } else {
            //     $principalImage = [];
            // }

            DB::beginTransaction();
            // if ($principalImage != []) {
                $tag = explode('-', $request['tag']);

                Mods::where('id', $id)->update([
                    'name'            => $request['name'],
                    'description'     => $request['description'],
                    'tagPt'           => $tag[0],
                    'tagEn'           => $tag[1],
                    'link'            => $request['link'],
                    'link_video'      => $request['link-video'],
                    'release'         => $request['release'],
                    'category_game'   => $request['category-game'],
                    'category'        => $request['category'],
                    'user_id'         => Auth::user()->id
                ]);
            // }
            DB::commit();
            return response(['id'=> $id], 200);
        } catch (Exception $e) {
            DB::rollBack();
            dd('teste');
        }
    }

    public function detail($id)
    {
        try {
            $categoryGame = games::getCategoriesGames();
            $categoryMod  = games::getCategoriesPt();
            $routesNames  = games::getRouteGame();
            $categoriesModsEn = games::getCategoriesEn();

            $mod      = Mods::where(['id'=> $id, 'approved'=>true])->get();
            if(Auth::check()){
                $mod  = Mods::where(['id'=> $id])->get();
            }
            $user     = $mod[0]->user_id ?? 0;
            $comments = Comments::where(['id_mod' => $id])
                ->join('users', 'comments.user_id', 'users.id')
                ->select('users.name', 'users.image', 'comments.*')
                ->orderBy('comments.id')->paginate(5);
           
            $likeSelect = false;
            $starSelect = false;
            $totalLikes = $mod[0]->total_likes ?? 0;
            $totalStars = $mod[0]->total_users_stars == 0 ? $mod[0]->total_stars : $mod[0]->total_stars / $mod[0]->total_users_stars;
           
            $mods       = Mods::where([['id', '<>', $mod[0]['id']], ['category', $mod[0]['category']], ['approved', true]])->paginate(5) ?? [];
            
            $star       = [];
            if (Auth::check()) {
                $star       = Stars::where(['user_id' => Auth::user()->id, 'id_mod' => $id])->get();
                $likeSelect = count(Likes::where(['user_id' => Auth::user()->id, 'id_mod' => $id])->get()) > 0 ? true : false;
                $starSelect = count($star) > 0 ? true : false;
                $likeSelect = Auth::user()->active ? $likeSelect : true;
                $starSelect = Auth::user()->active ? $likeSelect : true;
            }

            return view('mods.detail', compact('mod', 'id', 'comments', 'user', 'likeSelect', 'starSelect', 'totalLikes', 'totalStars', 'mods', 'star', 'routesNames', 'categoriesModsEn', 'categoryMod'));
        } catch (Exception $e) {
            // abort(500);
            return redirect(Route('index'));
        }

    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $mod      = Mods::where('id', $id)->get();
            $user     = $mod[0]->user_id ?? 0;
            $images   = json_decode($mod[0]->images);
            $comments = Comments::where(['id_mod' => $id])
                ->join('users', 'comments.user_id', 'users.id')
                ->select('users.name', 'users.image', 'comments.*')
                ->orderBy('comments.id')->get();
            /*apaga os comentarios*/ 
            foreach($comments as $value){
                $value->delete();
            }

            /*apaga as fotos*/
            foreach($images as $value){
                Storage::delete($value->path);
            }

            Storage::delete($mod[0]->principal_image);
            
            Mods::where('id', '=', $id)->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

        }
    }

    public function approvedMod(Request $request)
    {
        try {
            DB::beginTransaction();
                if (isset($request->type) && $request->type == 'true') {
                    Mods::where('id', '=', $request->id)->update(['approved' => false]);
                } else {
                    Mods::where('id', '=', $request->id)->update(['approved' => true]);
                }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

        }
    }

    public function deleteImage(Request $request,$id){
        try {
            DB::beginTransaction();
            $mod      = Mods::where('id', $id)->get();
            $images   = json_decode($mod[0]->images) ?? []; 
            
            foreach($images as $key => $value){
                if($request->path == $value->path){
                    unset($images[$key]);
                    Storage::delete($value->path);
                }else{
                   $pathImages[] = ['path'=>$value->path]; 
                }
            }

            Mods::where('id', '=', $id)->update(['images'=> json_encode($pathImages)]);
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollBack();

        }
    }

    public function getCategories(Request $request){
        switch($request->category_game){
            case 0:
                return GtavController::getCategories();
            break;
            case 1:
                return GtasaController::getCategories();
            break;
            case 2:
                return Ets2Controller::getCategories();
            break;
            case 3:
                return GtaivController::getCategories();
            break;
            case 4:
            break;
        }
    }

    public function getTags(Request $request){
        switch($request->category_game){
            case 0:
                return GtavController::getTags($request->category);
            break;
            case 1:
                return GtasaController::getTags($request->category);
            break;
            case 2:
                return Ets2Controller::getTags($request->category);
            break;
            case 3:
                return GtaivController::getTags($request->category);
            break;
            case 4:
            break;
        }
    }

    public function myMods(){
        try {
            $mods = Mods::orderBy('id','asc')->where(['user_id'=> Auth::user()->id])->paginate(6) ?? [];

            return view('admin.approved', ['mods'=>$mods]);
        } catch (Exception $e) {
            abort(400);
        }
    }

    public function download($id){
        try{
            DB::beginTransaction();
            
            $mod   = Mods::where('id', '=', $id);
            $total = $mod->get()[0]->total_downloads;
            $total+= 1;
            Mods::where(['id'=> $id])->update(['total_downloads'=> $total]); 
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
    }
}
