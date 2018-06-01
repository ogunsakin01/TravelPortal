<?php

namespace App\Http\Middleware;

use Closure;

class CheckAvailableItineraries
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
        if( !session()->exists('availableItineraries') || is_null(session()->get('availableItineraries')) || empty(session()->get('availableItineraries'))){
            return redirect('/');
        }

        return $next($request);
    }
}
