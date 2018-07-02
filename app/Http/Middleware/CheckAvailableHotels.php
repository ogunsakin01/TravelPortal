<?php

namespace App\Http\Middleware;

use Closure;

class CheckAvailableHotels
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
        if( !session()->exists('availableHotels') || is_null(session()->get('availableHotels')) || empty(session()->get('availableHotels'))){
            return redirect('/');
        }

        return $next($request);
    }
}
