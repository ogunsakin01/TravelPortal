<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightDeal extends Model
{
    protected $fillable = [
        'package_id',
        'origin',
        'destination',
        'date',
        'airline',
        'cabin',
        'information'
    ];

    public static function store($data){

        $flight = static::updateOrCreate(
            [
                'package_id'    => $data->package_id
            ],

            [
                'origin'         => $data->origin,
                'destination'    => $data->destination,
                'date'           => $data->date,
                'airline'        => $data->airline,
                'cabin'          => $data->cabin,
                'information'    => $data->information
            ]

        );

        return $flight;

    }

    public static function getByPackageId($id){

        return static::where('package_id', $id)->first();
    }
}
