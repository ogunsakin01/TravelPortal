<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageHotel extends Model
{
    protected $fillable = ['package_id', 'hotel_name', 'address', 'hotel_star_rating', 'hotel_location', 'hotel_info'];

    public static function store($r)
    {
        for($i = 0; $i < count($r->hotel_name); $i++)
        {
            $hotel = [
                'package_id' => $r->package_id,
                'hotel_name' => $r->hotel_name[$i],
                'address' => $r->address[$i],
                'hotel_star_rating' => $r->hotel_star_rating[$i],
                'hotel_location' => $r->hotel_location[$i],
                'hotel_info' => $r->hotel_info[$i],
            ];
            static::create($hotel);
        }
    }
}
