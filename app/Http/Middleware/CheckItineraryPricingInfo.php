<?php

namespace App\Http\Middleware;

use Closure;

class CheckItineraryPricingInfo
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
        if( !session()->exists('itineraryPricingInfo') || is_null(session()->get('itineraryPricingInfo')) || empty(session()->get('itineraryPricingInfo'))){
            return redirect('/');
        }

        return $next($request);
    }
}
