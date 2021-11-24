<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    /* Faz a atualizão da foto de perfil. */ 
    public function updateImage(Request $request)
    {
        DB::beginTransaction();
        try {
            Storage::delete(Auth::user()->image);
            $id = Auth()->user()->id;
                
            // returns \Intervention\Image\Image - OK
            $resize         = Image::make($request->img)
                            ->resize(512, null, function ($constraint) { $constraint->aspectRatio(); } )
                            ->encode('png',80);
            
            // calculate md5 hash of encoded image
            $hash           = md5($resize->__toString());
            
            // use hash as a name
            $imgPerfil = "user/img/perfil/{$id}-{$hash}.png";

            Storage::put($imgPerfil, $resize);

            User::where('id', Auth::user()->id)->update([
                'image' => $imgPerfil
            ]);

            DB::commit();
            return redirect(Route('user-edit'));
        } catch (Exception $e) {
            Storage::delete($imgPerfil);
            DB::rollback();
            return redirect()->route('user-edit');
        }
    }

    /* Atualiza a senha com a nova. */ 
    public function updatePassword(Request $request){
        DB::beginTransaction();
        try {
            if(Hash::check($request->password_old, Auth::user()->password)){
                User::where('id', Auth::user()->id)->update([
                    'password' => Hash::make($request['password'])
                ]);
                
            }else{
                return response(['error'], 400);
            }
            DB::commit();
            return response(['success'], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response(['error'], 400);
        }
    }

    /* Lista todos os usuarios. */ 
    public function getStrutureUsers(){
        try{
            $users = User::orderBy('id','asc')->paginate(5);

            return view('admin.list-user', ['users'=>$users]);
        }catch (Exception $e){

        }
    }

    /* Habilita um usuario*/ 
    public function activeUser($id){
        try{
            DB::beginTransaction();

            User::where('id', $id)->update([
                'active' => true
            ]);

            DB::commit();
            return response(['success'], 200);
        }catch (Exception $e){
            DB::rollBack();

        }
    }

    /* Desabilita um usuario. */
    public function disableUser($id){
        try{
            DB::beginTransaction();

            User::where('id', $id)->update([
                'active' => false
            ]);

            DB::commit();
            return response(['success'], 200);
        }catch (Exception $e){
            DB::rollBack();

        }
    }
}
