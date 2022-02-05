<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class userIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $month = Carbon::now()->format('m');
        $year  = Carbon::now()->format('Y');

        /* Salva o ano e o mes*/ 
        Session::put('month', $month);
        Session::put('year', $year);

        /* verifica se o usuario é admin. */ 
        if(isset(Auth::user()->type_user) && Auth::user()->type_user !== 0) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
