<?php

namespace App\Http\Controllers;

use App\Services\PortalCustomNotificationHandler;
use App\User;
use Illuminate\Http\Request;
use App\Wallet;
use App\WalletLog;
use nilsenj\Toastr\Facades\Toastr;
use App\FlightBooking;
use App\HotelBooking;
use App\PackageBooking;
use App\TravelPackage;
use App\Profile;

class WalletController extends Controller
{
    public function updateWallet(Request $request){

        $user = User::getUserById($request->user_id);
        $wallet = Wallet::where('user_id',$request->user_id)->first();
        $walletBalance = $wallet->balance;
        $newWalletBalance = $walletBalance;
        if($request->status == 1){
            $newWalletBalance = $walletBalance + ($request->amount * 100);
            $addLog = WalletLog::create([
                'user_id' => $request->user_id,
                'amount'  => ($request->amount * 100),
                'status'  => $request->status,
                'type_id' => 1,
            ]);
            PortalCustomNotificationHandler::walletCredit($user,$addLog);
        }
        elseif($request->status == 0){
            $newWalletBalance = $walletBalance - ($request->amount * 100);
            $addLog = WalletLog::create([
                'user_id' => $request->user_id,
                'amount'  => ($request->amount * 100),
                'status'  => $request->status,
                'type_id' => 2,
            ]);
            PortalCustomNotificationHandler::walletDebit($user,$addLog);
        }
        $wallet->balance = $newWalletBalance;
        $updateWallet = $wallet->update();
        if($addLog && $updateWallet){
            Toastr::success("User wallet updated successfully");
        }
        else{
            Toastr::danger("Sorry, unable to update user wallet");
        }
        return back();

    }

    public function itineraryWalletPayment(Request $request){
        $user = auth()->user();
        $wallet = Wallet::where('user_id',auth()->id())->first();
        $walletBalance = $wallet->balance;
        $newWalletBalance = $walletBalance;
        $newWalletBalance = $walletBalance - $request->amount;

        $addLog = WalletLog::create([
            'user_id' => $user->id,
            'amount'  => $request->amount,
            'status'  => 0,
            'type_id' => 5,
        ]);
        $response = [
            'reference' => 'WalletLog-'.$addLog->id,
            'amount'    => $request->amount
        ];
        $paymentInfo = [
            'status'  => 1,
            'message' => 'Wallet Payment Successful',
        ];

        $wallet->balance = $newWalletBalance;
        $updateWallet = $wallet->update();

        PortalCustomNotificationHandler::walletDebit($user,$addLog);
        $booking     = FlightBooking::where('reference',$request->booking_reference)->first();
        $booking->payment_status = 1;
        $booking->update();

        $profile  = Profile::getUserInfo($booking->user_id);
        PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

        session()->put('paymentInfo',$paymentInfo);
        return redirect('/flight-booking-confirmation');

    }

    public function hotelWalletPayment(Request $request){
        $user = auth()->user();
        $wallet = Wallet::where('user_id',auth()->id())->first();
        $walletBalance = $wallet->balance;
        $newWalletBalance = $walletBalance;
        $newWalletBalance = $walletBalance - $request->amount;
        $addLog = WalletLog::create([
            'user_id' => $user->id,
            'amount'  => $request->amount,
            'status'  => 0,
            'type_id' => 4,
        ]);

        $paymentInfo = [
            'status'  => 1,
            'message' => 'Wallet Payment Successful',
        ];

        $wallet->balance = $newWalletBalance;
        $updateWallet = $wallet->update();
        PortalCustomNotificationHandler::walletDebit($user,$addLog);
        $booking     = HotelBooking::where('reference',$request->booking_reference)->first();
        $booking->payment_status = 1;
        $booking->update();

        session()->put('paymentInfo',$paymentInfo);
        return redirect('/hotel-booking-confirmation');
    }

    public function dealWalletPayment(Request $request){
        $user = auth()->user();
        $wallet = Wallet::where('user_id',auth()->id())->first();
        $walletBalance = $wallet->balance;
        $newWalletBalance = $walletBalance;
        $newWalletBalance = $walletBalance - $request->amount;

        $addLog = WalletLog::create([
            'user_id' => $user->id,
            'amount'  => $request->amount,
            'status'  => 0,
            'type_id' => 6,
        ]);

        $paymentInfo = [
            'status'  => 1,
            'message' => 'Wallet Payment Successful',
        ];

        $wallet->balance = $newWalletBalance;
        $updateWallet = $wallet->update();

        PortalCustomNotificationHandler::walletDebit($user,$addLog);
        $booking     = PackageBooking::where('reference',$request->booking_reference)->first();
        $booking->payment_status = 1;
        $booking->update();

        $deal = TravelPackage::find($booking->package_id);

        $userWithProfile = User::where('id',auth()->id())
            ->with('profile')
            ->first();
        PortalCustomNotificationHandler::packageReservationComplete($booking,$deal,$userWithProfile);

        session()->put('paymentInfo',$paymentInfo);
        return redirect('/deals/booking-confirmation');
    }
}
