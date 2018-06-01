<?php

namespace App\Http\Middleware;

use Closure;

class CheckSelectedHotelRoomInformation
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
        if( !session()->exists('selectedHotelRoomInformation') || is_null(session()->get('selectedHotelRoomInformation')) || empty(session()->get('selectedHotelRoomInformation'))){
            return redirect('/');
        }
        return $next($request);
    }
}
