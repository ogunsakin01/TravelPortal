<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SightSeeing extends Model
{
    protected $fillable = [ 'package_id' , 'attraction_id' , 'title' , 'description' , 'id' ];

    public static function getSightseeingByPackageId($activity_id){
        return static::where('package_id', $activity_id)->get();
    }

    public static function deleteSight($id){
        $delete = static::where('id', $id)->delete();
        if($delete){
            flash('Sight seeing deleted successfully')->success();
            return back();
        }
    }

    public static function countSights($package_id){
        return static::where('package_id', $package_id)->count();
    }

    public static function store($r)
    {
        for($i = 0; $i < count($r->title); $i++) {
            $data = [
                'package_id' => $r->package_id,
                'attraction_id' => $r->attraction_id,
                'title' => $r->title[$i],
                'description' => $r->description[$i],
            ];
            static::create($data);
        }
    }

    public static function storeSightSeeing($r)
    {
        $sightSeeing = static::find($r['sight_seeing_id']);
        if(is_null($sightSeeing) || empty($sightSeeing)){
            $data = [
                'package_id'     => $r['package_id'],
                'attraction_id'  => $r['attraction_id'],
                'title'          => $r['title'],
                'description'    => $r['description'],
            ];
            return static::create($data);
        }else{
            return static::updateOrCreate(
                [
                    'id' => $r['sight_seeing_id'],
                ],
                [
                    'package_id'     => $r['package_id'],
                    'attraction_id'  => $r['attraction_id'],
                    'title'          => $r['title'],
                    'description'    => $r['description'],
                ]
            );
        }
    }

}
