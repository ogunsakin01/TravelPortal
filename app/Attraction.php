<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    protected $fillable = [
        'package_id',
        'name',
        'city',
        'address',
        'date',
        'information'
    ];

    public static function store($data){

        $attraction = static::updateOrCreate(
            [
                'package_id' => $data->package_id
            ],

            [
                'name' => $data->name,
                'city' => $data->city,
                'address' => $data->address,
                'date'  => $data->date,
                'information' => $data->information
            ]
        );

        return $attraction;
    }

    public static function getByPackageId($id){

        return static::where('package_id', $id)->first();

    }

    public function sightSeeings(){
        return $this->hasMany(SightSeeing::class,'attraction_id','id');
    }
}
