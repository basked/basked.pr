<?php

namespace Modules\Skill\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecondMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$p1, $p2)
    {
        echo "<br>skill-SecondMiddleware: p1=$p1, p2=$p2";
        return $next($request);
    }
}
