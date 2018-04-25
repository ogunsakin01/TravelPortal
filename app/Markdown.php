<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Markdown extends Model
{
    protected $fillable = [
        'airline_code',
        'type',
        'value'
    ];

    public static function getAirlineMarkdown($airline_code){
        $a = static::where('airline_code', $airline_code)->first();
        if(empty($a) || is_null($a)){
            return 0;
        }else{
            return $a;
        }
    }

    public static function store($data){
        $markdown = static::updateOrCreate(
            [
                'airline_code' => $data->airlineCode
            ],
            [
                'type'  => $data->value_type,
                'value' => $data->value,
            ]);

        return $markdown;
    }

    public static function getMarkdownWithId($id){
        return static::where('id',$id)->first();
    }
}
