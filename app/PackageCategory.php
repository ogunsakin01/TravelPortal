<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    protected $fillable = [
        'id',
        'category'
    ];

    public static function getPackageCategories(){
        $package_categories_list = static::where('status', '1')->get();
        $package_categories = array();
        foreach ($package_categories_list as $package_category){
            $package_categories[$package_category->id] = $package_category->category;
        }
        return $package_categories;
    }

    public static function getPackageCategoryList(){
        return static::where('status','1')->get();
    }

    public static function deletePackageCategory($id){
        $type = static::where('id', $id)->first();
        $type->status = 0;
        $type->update();
        if($type->update()){
            flash('Package category deleted successfully')->success();
        }
        return redirect(url('package/categories'));
    }

    public static function store($r){
        $updateOrCreate = static::updateOrCreate(
            [
                'id' => $r->category_id
            ],
            [
                'category' => $r->category
            ]
        );

        return $updateOrCreate;
    }
}
