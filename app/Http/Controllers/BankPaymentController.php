<?php

namespace App\Http\Controllers;

use App\BankPayment;
use App\Services\PortalCustomNotificationHandler;
use Illuminate\Http\Request;
use App\FlightBooking;
use nilsenj\Toastr\Facades\Toastr;

class BankPaymentController extends Controller
{
    public function itineraryBankPayment(Request $r){

        $pnr = session()->get('pnr');
        $booking = FlightBooking::where('pnr',$pnr)->first();
        $saveBankBooking = BankPayment::store($booking,$r->bank_details_id);

        PortalCustomNotificationHandler::PayByBank($booking);

        if($saveBankBooking){

            $paymentInfo = [
                'status' => 3,
                'message' => 'You selected the pay by bank option'
            ];

            session()->put('paymentInfo',$paymentInfo);
            return redirect('/flight-payment-confirmation');

        }

        else{
            Toastr::error('Unable to save bank payments option');
            return back();
        }

    }
}
