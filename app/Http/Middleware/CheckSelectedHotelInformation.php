<?php

namespace App\Http\Middleware;

use Closure;

class CheckSelectedHotelInformation
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
        if( !session()->exists('selectedHotelInformation') || is_null(session()->get('selectedHotelInformation')) || empty(session()->get('selectedHotelInformation'))){
            return redirect('/');
        }
        return $next($request);
    }
}
