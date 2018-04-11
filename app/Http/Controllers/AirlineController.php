<?php

namespace App\Http\Controllers;

use App\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function typeAhead(Request $request){

        $data = Airline::typeAhead($request);
        return response()->json($data);

    }
}
