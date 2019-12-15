<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class TablesMiddleware
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
        $tables = DB::select(DB::raw("SHOW TABLES;"));

        if (count($tables) == 0){
            return view("errors.engineerings");
        }
        else{
            return $next($request);
        }
    }
}
