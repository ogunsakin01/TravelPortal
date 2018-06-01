<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelDeal extends Model
{
    protected $fillable = [
        'name',
        'city',
        'address',
        'star_rating',
        'stay_start_date',
        'stay_duration',
        'stay_end_date',
        'information',
        'package_id'
    ];

    public static function store($data){

        $hotel = static::updateOrCreate(
            [
                'package_id' => $data->package_id
            ],

            [
                'name'         => $data->hotel_name,
                'city'         => $data->hotel_city,
                'address'        => $data->hotel_address,
                'star_rating'   => $data->hotel_rating,
                'stay_start_date' => $data->start_date,
                'stay_duration'  => $data->duration,
                'stay_end_date'  => $data->end_date,
                'information'    => $data->information
            ]
        );


        return $hotel;
    }

    public static function getByPackageId($id){

        return static::where('package_id', $id)->first();

    }
}
