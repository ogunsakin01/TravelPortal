<?php

namespace App\Http\Middleware;

use Closure;

class CheckHotelSearchParam
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
        if( !session()->exists('hotelSearchParam') || is_null(session()->get('hotelSearchParam')) || empty(session()->get('hotelSearchParam'))){
            return redirect('/');
        }

        return $next($request);
    }
}
