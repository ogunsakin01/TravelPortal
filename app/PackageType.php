<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{

    public static function getPackageTypes(){
        $package_types_list = static::where('status', '1')->get();
        $package_types = array();
        foreach ($package_types_list as $package_type){
            $package_types[$package_type->id] = $package_type->type;
        }
        return $package_types;
    }

    public static function getPackageTypeList(){
        return static::where('status','1')->get();
    }

    public static function deletePackageType($id){
        $type = static::where('id', $id)->first();
        $type->status = 0;
        $type->update();
        if($type->update()){
            flash('Package type deleted successfully')->success();
        }
        return redirect(url('package/types'));
    }

}
