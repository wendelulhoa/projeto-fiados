<?php

namespace App\Http\Controllers;

use App\Models\Mods;
use App\Models\Stars;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StarController extends Controller
{
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $starsExists = Stars::where([
                'id_mod'  => $request['id'],
                'user_id' => Auth::user()->id,
            ])->get();

            if (count($starsExists) == 0) {
                $mod   = Mods::where('id', '=', $request['id']);
                $mod   = $mod->get();
                $totalUsers = $mod[0]->total_users_stars + 1;
                $total      = $mod[0]->total_stars;
                $total = floatval($total) + floatval($request['total']);

                Mods::where(['id' => $request['id']])->update(['total_stars' => floatval($total), 'total_users_stars' => $totalUsers]);

                Stars::create([
                    'id_mod'  => $request['id'],
                    'stars'  => floatval($request['total']),
                    'user_id' => Auth::user()->id,
                ]);
            } else {
                return response(['error' => 'star já foi inserido'], 400);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response(['error' => $e], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();

            $stars     = Stars::where(['user_id' => Auth::user()->id, 'id_mod' => $request['id']]);
            $starsUser = $stars->get();

            if (count($starsUser) > 0) {
                $stars->delete();
                $stars = Mods::where(['id' => $request['id']])->get();
                $total = $stars[0]->total_stars - 1;
                Mods::where('id', '=', $request['id'])->update(['total_stars' => $total]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response(['error' => $e], 400);
        }
    }
}
