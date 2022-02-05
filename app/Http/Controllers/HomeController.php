<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $month = Carbon::now()->format('m');
        $year  = Carbon::now()->format('Y');

        /* Salva o ano e o mes*/ 
        Session::put('month', $month);
        Session::put('year', $year);

        switch(Auth::user()->type_user){
            case 0:
                return redirect()->route('client-index', [$month, $year]);
            break;
            case 1:
               return redirect()->route('admin-index', [$month, $year]);
            break;
        }
        return redirect()->route('admin-index');
    }
}
