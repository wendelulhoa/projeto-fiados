<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
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
        }
        return $next($request);
    }
}
