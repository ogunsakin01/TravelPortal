<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Airline extends Model
{
    public static function typeAhead($request){
        return Airline::select(DB::raw('CONCAT(code, " - ", name) AS name'))
            ->where("code","LIKE","%{$request->input('query')}%")
            ->orWhere("name","LIKE","%{$request->input('query')}%")
            ->get();
    }

    public static function getAirlineName($code){
        return static::where('code',$code)->first()->name;
    }
}
