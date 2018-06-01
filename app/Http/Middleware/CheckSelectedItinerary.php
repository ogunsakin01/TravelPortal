<?php

namespace App\Http\Middleware;

use Closure;

class CheckSelectedItinerary
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
        if( !session()->exists('selectedItinerary') || is_null(session()->get('selectedItinerary')) || empty(session()->get('selectedItinerary'))){
            return redirect('/');
        }

        return $next($request);
    }
}
