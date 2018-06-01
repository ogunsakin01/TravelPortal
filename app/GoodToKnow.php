<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodToKnow extends Model
{
    protected $fillable= ['package_id', 'title', 'description'];

    public static function getGoodToKnowByPackageId($activity_id){
        return static::where('package_id',$activity_id)->first();
    }

    public static function store($r)
    {
        for($i = 0; $i < count($r->title); $i++) {
            $data = [
                'package_id' => $r->package_id,
                'title' => $r->title[$i],
                'description' => $r->description[$i],
            ];
            static::create($data);
        }
    }
}
