<?php

namespace App\Http\Middleware;

use App\Helpers\Helper as Hp;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        if (!Hp::isEditor() && !Hp::isAdmin()){
            return redirect()->route("index");
        }
        else{
            return $next($request);
        }
    }
}
