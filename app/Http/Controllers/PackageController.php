<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function packageDetails()
    {
        return view('pages.package.package_details');
    }

    public function packageList()
    {
        return view('pages.package.package_list');
    }

    public function packagePaymentOption()
    {
        return view('pages.package.package_payment_option');
    }

    public function packagePaymentConfirmation()
    {
        return view('pages.package.package_payment_confirmation');
    }


}
