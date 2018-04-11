<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function availableItineraries(){
        $availableItineraries =  session()->get('availableItineraries');
        dd($availableItineraries);
    }

}
