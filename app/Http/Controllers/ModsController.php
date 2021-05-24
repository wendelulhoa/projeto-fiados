<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Likes;
use App\Models\Mods;
use App\Models\Stars;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ModsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $type         = null;
            $categoryGame = ['GTA V', 'GTA SA', ' ETS2', 'GTA IV', 'MODELOS 3D'];
            $categoryMod  = ['VEÍCULOS', 'CAMINHÕES', 'ÔNIBUS', 'ARMAS', 'SCRIPTS', 'JOGADOR', 'MAPAS', 'OUTROS', 'FERRAMENTAS', 'CONSTRUÇÕES', 'TEXTURA'];

            if (isset($request['category-game']) && !empty($request['category-game']) && empty($request['category-mod'])) {
                $type = $categoryGame[$request['category-game'] - 1];
                $mods = Mods::where(['category_game' => $request['category-game']])->paginate(9);
            } else if (isset($request['category-mod']) && isset($request['category-game']) && !empty($request['category-mod'])) {
                $type = $categoryGame[$request['category-game'] - 1];
                $mods = Mods::where(['category_game' => $request['category-game'], 'category' => $request['category-mod']])->paginate(9);
            } else if (isset($request->param)) {
                $request->param = strtoupper($request->param);
                $mods           = Mods::where([['name', 'ilike', '%' . $request->param . '%']])->orWhere([['description', 'ilike', '%' . $request->param . '%']])->paginate(9) ?? [];
            } else {
                $mods = DB::table('mods')->where('approved', '=', 'true')->paginate(9) ?? [];
            }

            return view('mods.mods', compact('mods', 'type', 'categoryGame', 'categoryMod'));
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
                $idMod = Mods::create([
                        'name'            => $request['name'],
                        'description'     => $request['description'],
                        'principal_image' => $principalImage,
                        'images'          => json_encode([]),
                        'approved'        => false,
                        'tags'            => $request['tag'],
                        'link'            => $request['link'],
                        'category_game'   => $request['category-game'],
                        'category'        => $request['category'],
                        'user_id'         => Auth::user()->id,
                        'total_likes'     => 0,
                        'total_stars'     => 0,
                        'total_users_stars'=> 0
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
            return response(['success'=> true], 200);
        }catch(Exception $e){
            dd($e);
            Storage::delete($imagesDelete);
            return response(['error'=> true], 400);
        }
    }

    public function edit(Request $request)
    {
        try {
            Mods::where('id', '=', 1)->update(['name' => 'wendel']);
        } catch (Exception $e) {

        }
    }

    public function detail($id)
    {
        try {
            $mod      = Mods::where('id', $id)->get();
            $user     = $mod[0]->user_id ?? 0;
            $comments = Comments::where(['id_mod' => $id])
                ->join('users', 'comments.user_id', 'users.id')
                ->select('users.name', 'users.image', 'comments.*')
                ->orderBy('comments.id')->get();
            $likeSelect = false;
            $starSelect = false;
            $totalLikes = $mod[0]->total_likes ?? 0;
            $totalStars = $mod[0]->total_users_stars == 0 ? $mod[0]->total_stars : $mod[0]->total_stars / $mod[0]->total_users_stars;
            $mods       = Mods::where([['id', '<>', $mod[0]['id']], ['category', $mod[0]['category']]])->paginate(5) ?? [];
            $star       = [];
            if (Auth::check()) {
                $star       = Stars::where(['user_id' => Auth::user()->id, 'id_mod' => $id])->get();
                $likeSelect = count(Likes::where(['user_id' => Auth::user()->id, 'id_mod' => $id])->get()) > 0 ? true : false;
                $starSelect = count($star) > 0 ? true : false;
            }

            return view('mods.detail', compact('mod', 'id', 'comments', 'user', 'likeSelect', 'starSelect', 'totalLikes', 'totalStars', 'mods', 'star'));
        } catch (Exception $e) {
            abort(500);
        }

    }

    public function delete()
    {
        try {
            Mods::where('id', '=', 1)->delete();
        } catch (Exception $e) {

        }
    }

    public function approvedMod(Request $request)
    {
        try {
            if (isset($request->type) && $request->type == 'true') {
                Mods::where('id', '=', $request->id)->update(['approved' => false]);
            } else {
                Mods::where('id', '=', $request->id)->update(['approved' => true]);
            }
        } catch (Exception $e) {

        }
    }
}
