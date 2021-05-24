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
                $total = $mod->get()[0]->total_stars;
                $total = intval($total) + $request['total'];

                Mods::where(['id' => $request['id']])->update(['total_stars' => intval($total)]);

                Stars::create([
                    'id_mod'  => $request['id'],
                    'stars'  => $request['total'],
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
            $stars     = Stars::where(['user_id' => Auth::user()->id, 'id_mod' => $request['id']]);
            $starsUser = $stars->get();

            if (count($starsUser) > 0) {
                $stars->delete();
                $stars = Mods::where(['id' => $request['id']])->get();
                $total = $stars[0]->total_stars - 1;
                Mods::where('id', '=', $request['id'])->update(['total_stars' => $total]);
            }
        } catch (Exception $e) {
            return response(['error' => $e], 400);
        }
    }
}
