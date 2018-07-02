<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Airline extends Model
{

    public static function getAirline($iata_code)
    {
        $airline = static::where('code', $iata_code)->first();

        if(is_null($airline) || empty($airline))
        {
            return "";
        }
        else
        {
            return $airline->name;
        }

    }

    public static function getAirlineCodeByName($name){
        return static::where('name',$name)->first();
    }

    public static function typeAhead($request){

        return Airline::select(DB::raw('CONCAT(name) AS name'))
            ->where("code","LIKE","%{$request->input('query')}%")
            ->orWhere("name","LIKE","%{$request->input('query')}%")
            ->get();

    }

    public static function getAirlineName($code){
        $airline = static::where('code',$code)->first();
        if(is_null($airline) || empty($airline)){
            return "";
        }
        return $airline->name;
    }
}
