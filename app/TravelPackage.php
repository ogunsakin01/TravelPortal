<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    const
        ACTIVATED = 1,
        DEACTIVATED = 0;

    protected $fillable = [
        'category_id',
        'name',
        'flight',
        'hotel',
        'attraction',
        'phone_number',
        'information',
        'adult_price',
        'child_price',
        'infant_price',
        'status',
    ];

    public static function store($data){

        $package = static::updateOrCreate(
            [
                'id' => $data['default']->package_id
            ],

            [
                'category_id'  => $data['default']->category,
                'name'         => $data['default']->name,
                'flight'       => $data['flight'],
                'hotel'        => $data['hotel'],
                'attraction'   => $data['attraction'],
                'phone_number' => $data['default']->contact_number,
                'information'  => $data['default']->information,
                'adult_price'  => $data['default']->adult_price,
                'child_price'  => $data['default']->child_price,
                'infant_price' => $data['default']->infant_price,
                'status'       => 0
            ]
        );


        return $package;
    }

    public static function isDeactivated($id)
    {
        $package = static::find($id);
        if ($package)
        {
            if ($package->status == static::DEACTIVATED)
                return true;
        }
        return false;
    }

    public static function isActivated($id)
    {
        $package = static::find($id);
        if ($package)
        {
            if ($package->status == static::ACTIVATED)
                return true;
        }
        return false;
    }

    public static function activatePackage($id)
    {
        $package = static::find($id);
        $package->status = self::ACTIVATED;
        if ($package->update())
            return true;
        return false;
    }

    public static function deactivatePackage($id)
    {
        $package = static::find($id);
        $package->status = self::DEACTIVATED;
        if ($package->update())
            return true;
        return false;
    }

    public static function deletePackage($package_id){
        $delete_package = static::where('id', $package_id)->delete();
        $delete_gallery = Gallery::where('package_id', $package_id)->delete();

        flash('Package deleted successfully')->success();
        return redirect(url('backend/travel-packages/'));

    }

    public static function getAllPackagesDesc(){

        return static::orderBy('id','desc')->get();
    }

    public function images(){
        return $this->hasMany(Gallery::class,'package_id','id');
    }

    public function flightDeal(){
        return $this->hasOne(FlightDeal::class,'package_id','id');
    }

    public function hotelDeal(){
        return $this->hasOne(HotelDeal::class,'package_id','id');
    }

    public function attractionDeal(){
        return $this->hasOne(Attraction::class,'package_id','id');
    }

    public function sightSeeing(){
        return $this->hasMany(SightSeeing::class,'package_id','id');
    }

}
