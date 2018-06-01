<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public static function getGalleryByPackageId($activity_id){
        return static::where('package_id',$activity_id)->get();
    }

    public static function deletePicture($id){
        $delete = static::where('id', $id)->delete();
        if($delete){
            flash('Picture deleted successfully')->success();
            return back();
        }
    }

    public function package(){
        return $this->belongsTo(Package::class, 'package_id');
    }

    public static function getGalleryByParentId($id){
        return static::where('parent_id', $id)->get();
    }
}
