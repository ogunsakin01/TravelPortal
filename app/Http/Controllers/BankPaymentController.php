<?php

namespace App\Http\Controllers;

use App\BankPayment;
use App\HotelBooking;
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
            return redirect('/flight-booking-confirmation');

        }

        else{
            Toastr::error('Unable to save bank payments option');
            return back();
        }

    }

    public function hotelBankPayment(Request $r){

        $booking = HotelBooking::where('reference',$r->booking_reference)->first();

        $saveBankBooking = BankPayment::store($booking,$r->bank_details_id);

        PortalCustomNotificationHandler::PayByBank($booking);

        if($saveBankBooking){

            $paymentInfo = [
                'status' => 3,
                'message' => 'You selected the pay by bank option'
            ];

            session()->put('paymentInfo',$paymentInfo);

            if(substr($r->booking_reference,0,3) == "AIR"){
                return redirect('/flight-booking-confirmation');
            }elseif(substr($r->booking_reference,0,3) == "HOT"){
                return redirect('/hotel-booking-confirmation');
            }
        }
        else{
            Toastr::error('Unable to save bank payments option');
            return back();
        }
    }

    public function updatePaymentProof(Request $r){

        $this->validate($r,[
            'payment_proof_file' => 'required|max:10000|mimes:jpg,png,jpeg',
        ]);

        $file = $r->file('payment_proof_file');
        $fileName = time().$file->getClientOriginalName();
        $filePath = '/payment-proofs/'.$fileName;
        $uploadFile = $file->move(public_path('/payment-proofs/'),$fileName);

        $bankPayment = BankPayment::where('user_id',$r->user_id)->first();
        $bankPayment->slip_photo = $filePath;
        $updateBankPayment = $bankPayment->update();

        if($uploadFile && $updateBankPayment){
            Toastr::success("Payment proof updated successfully");
        }else{
            Toastr::error("Unable to unpdate payment proof");
        }

        return back();

    }

    public function updatePaymentStatus($id,$type){
        $bankPayment = BankPayment::find($id);
        $bankPayment->status = $type;
        $updateBankPayment = $bankPayment->update();
        if($updateBankPayment){
            return 1;
        }
        return 0;
    }
}
