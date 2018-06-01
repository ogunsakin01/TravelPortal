<?php

namespace App\Http\Middleware;

use Closure;

class CheckPaymentInfo
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
        if( !session()->exists('paymentInfo') || is_null(session()->get('paymentInfo')) || empty(session()->get('paymentInfo'))){
            return redirect('/');
        }
        return $next($request);
    }
}
