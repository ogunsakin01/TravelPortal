<?php

namespace App\Http\Controllers;

use App\BankPayment;
use App\EmailSubscriber;
use App\FlightBooking;
use App\Gender;
use App\HotelBooking;
use App\OnlinePayment;
use App\PackageBooking;
use App\Profile;
use App\Title;
use App\User;
use App\VisaApplication;
use App\Wallet;
use App\WalletLog;
use Illuminate\Http\Request;
use App\MarkupType;
use App\MarkupValueType;
use App\Vat;
use App\Role;
use App\Markdown;
use nilsenj\Toastr\Facades\Toastr;
use App\Services\InterswitchConfig;

class BackEndViewController extends Controller
{

    public function dashboard(){
        $visaApplications = VisaApplication::orderBy('id','desc')->get();
        $generalTotalFlightBookings = FlightBooking::where('payment_status','1')->count();
        $generalTotalHotelBookings = HotelBooking::where('payment_status','1')->count();
        $generalTotalPackageBookings    = PackageBooking::where('payment_status','1')->count();
        $generalSuccessfulFlightBookingPrice =  FlightBooking::where('payment_status',1)->sum('total_amount');
        $generalSuccessfulHotelBookingPrice  = HotelBooking::where('payment_status',1)->sum('total_amount');
        $generalSuccessfulPackageBookingPrice = PackageBooking::where('payment_status',1)->sum('total_amount');
        $userGeneralTotalFlightBookings = FlightBooking::where('payment_status','1')->where('user_id',auth()->id())->count();
        $userGeneralTotalHotelBookings = HotelBooking::where('payment_status','1')->where('user_id',auth()->id())->count();
        $userGeneralTotalPackageBookings    = PackageBooking::where('payment_status','1')->where('user_id',auth()->id())->count();
        $userGeneralSuccessfulFlightBookingPrice =  FlightBooking::where('payment_status',1)->where('user_id',auth()->id())->sum('total_amount');
        $userGeneralSuccessfulHotelBookingPrice  = HotelBooking::where('payment_status',1)->where('user_id',auth()->id())->sum('total_amount');
        $userGeneralSuccessfulPackageBookingPrice = PackageBooking::where('payment_status',1)->where('user_id',auth()->id())->sum('total_amount');
        return view('pages.backend.dashboard',compact('visaApplications','generalTotalPackageBookings','generalTotalFlightBookings','generalTotalHotelBookings','generalSuccessfulFlightBookingPrice','generalSuccessfulHotelBookingPrice','generalSuccessfulPackageBookingPrice','userGeneralTotalPackageBookings','userGeneralTotalFlightBookings','userGeneralTotalHotelBookings','userGeneralSuccessfulFlightBookingPrice','userGeneralSuccessfulHotelBookingPrice','userGeneralSuccessfulPackageBookingPrice'));
    }

    public function vat(){
        $markups = new MarkupType();

        $valueTypes = new MarkupValueType();

        $vat_types = $markups->fetchTypes();

        $vat_value_types = $valueTypes->fetchTypes();

        $vat = Vat::find(1);

        return view('pages.backend.settings.vats',compact('vat_types', 'vat_value_types','vat'));
    }

    public function markupView()
    {
        $markups = new MarkupType();

        $valueTypes = new MarkupValueType();

        $roles = new Role();

        $markup_types = $markups->fetchTypes();

        $markup_value_types = $valueTypes->fetchTypes();

        $roles = $roles->fetchRolesExceptAdmin();

        return view('pages/backend/settings/markups', compact('markup_types', 'markup_value_types', 'roles'));
    }

    public function index(){

        $markdowns = Markdown::all();
        return view('pages.backend.settings.markdown',compact('markdowns'));

    }

    public function profile(){
        $user = auth()->user();
        $profile = Profile::getUserInfo($user->id);
        return view('pages.backend.settings.profile',compact('user','profile'));
    }

    public function userFlightBookings(){

        $bookings = FlightBooking::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();

        $issuedTickets = count(FlightBooking::where('user_id',auth()->user()->id)->where('issue_ticket_status',1)->get());
        $canceledReservations = count(FlightBooking::where('user_id',auth()->user()->id)->where('cancel_ticket_status',1)->get());
        $voidTickets = count(FlightBooking::where('user_id',auth()->user()->id)->where('void_ticket_status',1)->get());
        return view('pages.backend.bookings.flight.user',compact('bookings','issuedTickets','canceledReservations','voidTickets'));
    }

    public function agentFlightBookings(){
        $bookings = FlightBooking::orderBy('id','desc')->get();
        $issuedTickets = 0;
        $canceledReservations = 0;
        $voidTickets = 0;
        $agentReservations = 0;
        foreach($bookings as $i => $booking){

            $agent = User::find($booking->user_id);

            if($agent->hasRole('agent')){

                if($booking->issue_ticket_status == 1){
                    $issuedTickets = $issuedTickets + 1;
                }

                if($booking->cancel_tiket_status == 1){
                    $canceledReservations = $canceledReservations + 1;
                }

                if($booking->void_ticket_status == 1){
                    $voidTickets = $voidTickets + 1;
                }

                $agentReservations = $agentReservations + 1;
            }

        }

        return view('pages.backend.bookings.flight.agent',compact('bookings','issuedTickets','canceledReservations','voidTickets','agentReservations'));
    }

    public function customerFlightBookings(){

        $bookings = FlightBooking::orderBy('id','desc')->get();
        $issuedTickets = 0;
        $canceledReservations = 0;
        $voidTickets = 0;
        $customerReservations = 0;

        foreach($bookings as $i => $booking){

            $customer = User::find($booking->user_id);

            if($customer->hasRole('customer')){

                if($booking->issue_ticket_status == 1){
                    $issuedTickets = $issuedTickets + 1;
                }

                if($booking->cancel_tiket_status == 1){
                    $canceledReservations = $canceledReservations + 1;
                }

                if($booking->void_ticket_status == 1){
                    $voidTickets = $voidTickets + 1;
                }

                $customerReservations = $customerReservations + 1;

            }

        }

        return view('pages.backend.bookings.flight.customer',compact('bookings','issuedTickets','canceledReservations','voidTickets','customerReservations'));
    }

    public function itineraryBookingInformation($reference){
        $booking = FlightBooking::where('reference',$reference)->first();
        if(empty($booking) || is_null($booking)){
            Toastr::error('This booking does not exist in our database');
            return back();
        }
        return view('pages.backend.bookings.flight.itinerary_booking_information',compact('booking'));
    }

    public function paymentConfirmation(){
        $paymentInfo = session()->get('paymentInfo');
        return view('pages.backend.payment_confirmation',compact('paymentInfo'));
    }

    public function onlinePayment(){

        $interswitchPayments = OnlinePayment::where('gateway_id',1)->orderBy('id','desc')->get();
        $amountSuccessful = 0;
        $amountPending = 0;
        $countSuccessful = 0;
        $countPending = 0;
        foreach($interswitchPayments as $serial => $interswitchPayment){
            if($interswitchPayment->payment_status == 1){
                $amountSuccessful = $amountSuccessful + $interswitchPayment->amount;
                $countSuccessful = $countSuccessful + 1;
            }
            if($interswitchPayment->payment_status == 0){
                $amountPending = $amountPending + $interswitchPayment->amount;
                $countPending = $countPending + 1;
            }
        }
        return view('pages.backend.transactions.online_payments',compact('interswitchPayments','amountSuccessful','amountPending','countSuccessful','countPending'));

    }

    public function userOnlinePayment(){

        $interswitchPayments = OnlinePayment::where('gateway_id',1)->where('user_id',auth()->id())->orderBy('id','desc')->get();
        $amountSuccessful = 0;
        $amountPending = 0;
        $countSuccessful = 0;
        $countPending = 0;
        foreach($interswitchPayments as $serial => $interswitchPayment){
            if($interswitchPayment->payment_status == 1){
                $amountSuccessful = $amountSuccessful + $interswitchPayment->amount;
                $countSuccessful = $countSuccessful + 1;
            }
            if($interswitchPayment->payment_status == 0){
                $amountPending = $amountPending + $interswitchPayment->amount;
                $countPending = $countPending + 1;
            }
        }
        return view('pages.backend.transactions.user_online_payments',compact('interswitchPayments','amountSuccessful','amountPending','countSuccessful','countPending'));

    }

    public function usersManagement(){

        $users   = User::where('delete_status',0)
            ->join('profiles','profiles.user_id','=','users.id')
            ->join('role_user','role_user.user_id','=','users.id')
            ->get();
        $titles  = Title::all();
        $genders = Gender::all();
        $roles   = Role::all();

        return view('pages.backend.settings.user-management',compact('users','titles','genders','roles'));

    }

    public function userHotelBookings(){
        $bookings = HotelBooking::where('user_id',auth()->id())
            ->orderBy('id','desc')
            ->get();
        $paidSuccessfulBookings = count(HotelBooking::where('user_id',auth()->id())
            ->where('payment_status',1)
            ->where('reservation_status',1)
            ->get());
        $paidUnsuccessfulBookings = count(HotelBooking::where('user_id',auth()->id())
            ->where('payment_status',1)
            ->where('reservation_status',0)
            ->get());
        $failedBookings = count(HotelBooking::where('user_id',auth()->id())
            ->where('payment_status',0)
            ->get());
        $cancelledBookings = count(HotelBooking::where('user_id',auth()->id())
            ->where('cancellation_status',1)
            ->get());

        return view('pages.backend.bookings.hotel.user',compact('bookings','paidSuccessfulBookings','paidUnsuccessfulBookings','failedBookings','cancelledBookings'));
    }

    public function agentHotelBookings(){

        $allBookings = HotelBooking::orderBy('id','desc')->get();
        $agentBookings = [];
        $paidSuccessfulBookings = 0;
        $paidUnsuccessfulBookings = 0;
        $failedBookings = 0;
        $cancelledBookings = 0;

        foreach($allBookings as $serial => $allBooking){
            if(User::find($allBooking->user_id)->hasRole('agent')){
                array_push($agentBookings,$allBooking);
            }
        }

        foreach($agentBookings as $i => $agentBooking){
            if($agentBooking->payment_status == 1 && $agentBooking->reservation_status == 1){
                $paidSuccessfulBookings = $paidSuccessfulBookings + 1;
            }
            if($agentBooking->payment_status == 1 && $agentBooking->reservation_status == 0){
                $paidUnsuccessfulBookings = $paidUnsuccessfulBookings + 1;
            }
            if($agentBooking->payment_status == 0){
                $failedBookings = $failedBookings + 1;
            }
            if($agentBooking->cancellation_status == 1){
                $cancelledBookings = $cancelledBookings + 1;
            }
        }

        return view('pages.backend.bookings.hotel.customer',compact('agentBookings','paidSuccessfulBookings','paidUnsuccessfulBookings','failedBookings','cancelledBookings'));

    }

    public function customerHotelBookings(){
        $allBookings = HotelBooking::orderBy('id','desc')->get();
        $customerBookings = [];
        $paidSuccessfulBookings = 0;
        $paidUnsuccessfulBookings = 0;
        $failedBookings = 0;
        $cancelledBookings = 0;

        foreach($allBookings as $serial => $allBooking){
            if(User::find($allBooking->user_id)->hasRole('customer')){
                array_push($customerBookings,$allBooking);
            }
        }

        foreach($customerBookings as $i => $customerBooking){
            if($customerBooking->payment_status == 1 && $customerBooking->reservation_status == 1){
                $paidSuccessfulBookings = $paidSuccessfulBookings + 1;
            }
            if($customerBooking->payment_status == 1 && $customerBooking->reservation_status == 0){
                $paidUnsuccessfulBookings = $paidUnsuccessfulBookings + 1;
            }
            if($customerBooking->payment_status == 0){
                $failedBookings = $failedBookings + 1;
            }
            if($customerBooking->cancellation_status == 1){
                $cancelledBookings = $cancelledBookings + 1;
            }
        }

        return view('pages.backend.bookings.hotel.customer',compact('customerBookings','paidSuccessfulBookings','paidUnsuccessfulBookings','failedBookings','cancelledBookings'));

    }

    public function hotelBookingInformation($reference){

        $booking = HotelBooking::where('reference',$reference)->first();
        if(empty($booking) || is_null($booking)){
            Toastr::error('This reservation does not exist in our database');
            return back();
        }

        return view('pages.backend.bookings.hotel.hotel_booking_information',compact('booking'));
    }

    public function walletsManagement(){
        $wallets = Wallet::orderBy('id','desc')->get();
        $walletLogs = WalletLog::orderBy('id','desc')->get();
        return view('pages.backend.settings.wallets_management',compact('wallets','walletLogs'));
    }

    public function userWallet(){
        $userWallet = Wallet::where('user_id',auth()->id())->first();

        $userWalletLogs = WalletLog::where('user_id',auth()->id())->get();
        $walletCredits = WalletLog::where('user_id',auth()->id())
            ->where('status',1)
            ->sum('amount');
        $walletDebits = WalletLog::where('user_id',auth()->id())
            ->where('status',0)
            ->sum('amount');
        $InterswitchConfig = new InterswitchConfig();
        $user = User::authenticatedUserInfo();
        return view('pages.backend.user_wallet',compact('userWallet','userWalletLogs','walletCredits','walletDebits','InterswitchConfig','user'));
    }

    public function bankPayment(){
        $bankPayments     = BankPayment::orderBy('id','desc')->get();
        $amountSuccessful = BankPayment::where('status',1)->sum('amount');
        $amountPending    = BankPayment::where('status',2)->sum('amount');
        $amountDeclined   = BankPayment::where('status',0)->sum('amount');
        $countSuccessful  = BankPayment::where('status',1)->count();
        $countPending     = BankPayment::where('status',2)->count();
        $countDeclined    = BankPayment::where('status',0)->count();
        return view('pages.backend.transactions.bank_payments',compact('bankPayments','amountSuccessful','amountPending','amountDeclined','countSuccessful','countPending','countDeclined'));
    }

    public function userBankPayment(){
        $bankPayments     = BankPayment::orderBy('id','desc')->where('user_id',auth()->id())->get();
        $amountSuccessful = BankPayment::where('status',1)->where('user_id',auth()->id())->sum('amount');
        $amountPending    = BankPayment::where('status',2)->where('user_id',auth()->id())->sum('amount');
        $amountDeclined   = BankPayment::where('status',0)->where('user_id',auth()->id())->sum('amount');
        $countSuccessful  = BankPayment::where('status',1)->where('user_id',auth()->id())->count();
        $countPending     = BankPayment::where('status',2)->where('user_id',auth()->id())->count();
        $countDeclined    = BankPayment::where('status',0)->where('user_id',auth()->id())->count();
        return view('pages.backend.transactions.user_bank_payments',compact('bankPayments','amountSuccessful','amountPending','amountDeclined','countSuccessful','countPending','countDeclined'));
    }

    public function emailSubscriptions(){
        $emails = EmailSubscriber::orderBy('id','desc')->get();
        return view('pages.backend.settings.email_subscriptions',compact('emails'));
    }

    public function visaApplicationRequests(){
        $visaApplications = VisaApplication::orderBy('id','desc')->get();
        return view('pages.backend.settings.visa_applications',compact('visaApplications'));
    }

    public function userPackageBookings(){
        $userBookings = PackageBooking::where('user_id',auth()->id())->with('deal')->get();
        $paidBookings = PackageBooking::where('user_id',auth()->id())->where('payment_status',1)->count();
        $pendingBookings = PackageBooking::where('user_id',auth()->id())->where('payment_status','!=',1)->count();
        return view('pages.backend.bookings.deal.user',compact('userBookings','paidBookings','pendingBookings'));
    }

    public function searchPortal(Request $r){
        $flightBooking1 = FlightBooking::where('pnr',$r->key)->first();
        $flightBooking2 = FlightBooking::where('reference',$r->key)->first();
        $hotelBooking1 = HotelBooking::where('pnr',$r->key)->first();
        $hotelBooking2 = HotelBooking::where('reference',$r->key)->first();
        $packageBooking = PackageBooking::where('reference',$r->key)->first();
        if(!is_null($flightBooking1) && !empty($flightBooking1)){
            return [
                'status'   => 1,
                'redirect' => url('/bookings/flight/itinerary-booking-information/'.$flightBooking1->reference)
            ];
        }elseif(!is_null($flightBooking2) && !empty($flightBooking2)){
            return [
                'status'   => 1,
                'redirect' => url('/bookings/flight/itinerary-booking-information/'.$flightBooking2->reference)
            ];
        }elseif(!is_null($hotelBooking1) && !empty($hotelBooking1)){
            return [
                'status'   => 1,
                'redirect' => url('/bookings/hotel/hotel-reservation-information/'.$hotelBooking1->reference)
            ];
        }elseif(!is_null($hotelBooking2) && !empty($hotelBooking2)){
            return [
                'status'   => 1,
                'redirect' => url('/bookings/hotel/hotel-reservation-information/'.$hotelBooking2->reference)
            ];
        }elseif(!is_null($packageBooking) && !empty($packageBooking)){
            return [
                'status'   => 1,
                'redirect' => url('/bookings/package/package-reservation-information/'.$packageBooking->reference)
            ];
        }
        else{
            return [
                'status' => 0,
                'message'       =>  'Nothing was found'
            ];
        }
    }

}
