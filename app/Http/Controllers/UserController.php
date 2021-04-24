<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function create(Request $request){
        DB::beginTransaction();
        try{
            User::create([
                'name'      => $request['username'],
                'email'     => $request['email'],
                'password'  => Hash::make($request['password']),
                'type_user' => 0
            ]);
        DB::commit();
        }catch(Exception $e){
        DB::rollback();
            return redirect()->route('view-create');
        }
    }

}
