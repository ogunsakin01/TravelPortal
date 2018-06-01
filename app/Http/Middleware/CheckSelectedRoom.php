<?php

namespace App\Http\Middleware;

use Closure;

class CheckSelectedRoom
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
        if( !session()->exists('selectedRoom') || is_null(session()->get('selectedRoom')) || empty(session()->get('selectedRoom'))){
            return redirect('/');
        }
        return $next($request);
    }
}
