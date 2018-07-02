<?php

namespace App\Http\Middleware;

use Closure;
use nilsenj\Toastr\Facades\Toastr;

class checkDealBookingId
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
        if( !session()->exists('deal_booking_id') || is_null(session()->get('deal_booking_id')) || empty(session()->get('deal_booking_id'))){
            Toastr::error('No deal booking available, please start the booking process again','Invalid Access');
            return redirect('/');
        }

        return $next($request);
    }
}
