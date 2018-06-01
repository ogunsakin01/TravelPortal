<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    const
        ACTIVATED = 1,
        DEACTIVATED = 0;

    public function packageType(){
        return $this->belongsTo(PackageType::class, 'package_type_id');
    }

    public function packageCategory()
    {
        return $this->belongsTo(PackageCategory::class, 'package_category_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_spoken_id', 'id');
    }

    public static function getActivities()
    {
        return static::all();
    }

    public static function deletePackage($package_id){
        $delete_package = static::where('id', $package_id)->delete();
        $delete_gallery = Gallery::where('package_id', $package_id)->delete();
        $delete_goodToKnow = GoodToKnow::where('package_id', $package_id)->delete();

        if($delete_gallery && $delete_goodToKnow && $delete_package){
            flash('Activity deleted successfully')->success();
            return redirect(url('activities'));
        }
    }

    public static function getPackageById($activity_id){
        return static::where('id', $activity_id)->first();
    }

    public static function store($request)
    {
        $package = new static;
        $package->flight=$request->flight;
        $package->hotel=$request->hotel;
        $package->attraction=$request->attraction;
        $package->package_category_id=$request->package_category_id;
        $package->package_name=$request->package_name;
        $package->phone_number=$request->phone_number;
        $package->time_length=$request->time_length;
        $package->info=$request->info;
        $package->status = self::DEACTIVATED;
        $package->adult_price=$request->adult_price;
        $package->kids_price=$request->kids_price;
        if ($package->save())
            return $package;

        return false;
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

    public static function getAttractionPackages(){
        $a = static::where('attraction', 1)
            ->where('flight',0)
            ->where('hotel',0)
            ->get();
        if(empty($a) || is_null($a)){
            return [];
        }else{
            return $a;
        }
    }

    public static function getFLightPackages(){
        $a = static::where('attraction', 0)
            ->where('flight',1)
            ->where('hotel',0)
            ->get();
        if(empty($a) || is_null($a)){
            return [];
        }else{
            return $a;
        }
    }

    public static function getHotelPackages(){
        $a = static::where('attraction', 0)
            ->where('flight',0)
            ->where('hotel',1)
            ->get();
        if(empty($a) || is_null($a)){
            return [];
        }else{
            return $a;
        }
    }
}
