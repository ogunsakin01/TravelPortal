<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Airport extends Model
{
    public static function typeAhead($request){

        return Airport::select(DB::raw('CONCAT(code, " - ", name) AS name'))
            ->where("code","LIKE","%{$request->input('query')}%")
            ->orWhere("name","LIKE","%{$request->input('query')}%")
            ->get();
    }
}
