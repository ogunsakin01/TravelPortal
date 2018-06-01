<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageAttraction extends Model
{
    protected $fillable = ['package_id', 'attraction_name', 'address', 'transports', 'duration'];

    public static function store($r)
    {
        $data = [
            'package_id' => $r->package_id,
            'attraction_name' => $r->attraction_name,
            'address' => $r->address,
            'transports' => $r->transports,
            'duration' => $r->duration,
        ];
        return static::create($data);
    }
}
