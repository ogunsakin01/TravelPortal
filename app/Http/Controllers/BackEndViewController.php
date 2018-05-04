<?php

namespace App\Http\Controllers;

use App\FlightBooking;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use App\MarkupType;
use App\MarkupValueType;
use App\Vat;
use App\Role;
use App\Markdown;
use nilsenj\Toastr\Facades\Toastr;

class BackEndViewController extends Controller
{
   public function dashboard(){
       return view('pages.backend.dashboard');
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

}
