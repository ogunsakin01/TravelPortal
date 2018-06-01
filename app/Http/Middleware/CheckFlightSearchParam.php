<?php

namespace App\Http\Middleware;

use Closure;

class CheckFlightSearchParam
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
        if( !session()->exists('flightSearchParam') || is_null(session()->get('flightSearchParam')) || empty(session()->get('flightSearchParam'))){
            return redirect('/');
        }
        return $next($request);
    }
}
