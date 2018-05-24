<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\WalletLog;
use nilsenj\Toastr\Facades\Toastr;

class WalletController extends Controller
{

    public function updateWallet(Request $request){

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
        }
        elseif($request->status == 0){
            $newWalletBalance = $walletBalance - ($request->amount * 100);
            $addLog = WalletLog::create([
                'user_id' => $request->user_id,
                'amount'  => ($request->amount * 100),
                'status'  => $request->status,
                'type_id' => 2,
            ]);
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
}
