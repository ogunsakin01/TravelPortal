<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function fetchBanks()
    {
        return static::pluck('name', 'id')->all();
    }

    public static function getAllBanks(){
        return static::all();
    }

    public static function getBankById($id){
        return static::find($id);
    }
}
