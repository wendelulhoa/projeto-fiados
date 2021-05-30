<?php

namespace App\Http\Middleware;

use Closure;

class verifyHost
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
        if(strripos(Route('index'), '204.48.17.111')){
            return redirect('https://www.ulhoamods.com');
        }
        return $next($request);
    }
}
