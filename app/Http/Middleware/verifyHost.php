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
            if(strripos(Route('index'), '134.209.208.63') || !strripos(Route('index'), 'ulhoamods.com')){
                return redirect('https://www.ulhoamods.com');
            }
        return $next($request);
    }
}
