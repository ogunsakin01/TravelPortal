<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{

    public $flight = 1;
    public $hotel = 2;
    public $car = 3;
    public $package = 4;

    public static function getVat()
    {
        return static::where('id', 1)->first();
    }

    public function updateOrCreateVat(array $data)
    {
        $vat = static::where('id', 1)
            ->first();

        if (is_null($vat))
        {
            $vat = new static();

            if ($data['vat_type'] == $this->flight)
            {
                $vat->flight_vat_type = $data['vat_value_type'];
                $vat->flight_vat_value = $data['vat_value'];
            }
            elseif ($data['vat_type'] == $this->hotel)
            {
                $vat->hotel_vat_type = $data['vat_value_type'];
                $vat->hotel_vat_value = $data['vat_value'];
            }
            elseif ($data['vat_type'] == $this->car)
            {
                $vat->car_vat_type = $data['vat_value_type'];
                $vat->car_vat_value = $data['vat_value'];
            }
            elseif ($data['vat_type'] == $this->package)
            {
                $vat->package_vat_type = $data['vat_value_type'];
                $vat->package_vat_value = $data['vat_value'];
            }

            if ($vat->save())
            {
                return true;
            }
            return false;
        }
        else
        {
            if ($data['vat_type'] == $this->flight)
            {
                $vat->flight_vat_type = $data['vat_value_type'];
                $vat->flight_vat_value = $data['vat_value'];
            }
            elseif ($data['vat_type'] == $this->hotel)
            {
                $vat->hotel_vat_type = $data['vat_value_type'];
                $vat->hotel_vat_value = $data['vat_value'];
            }
            elseif ($data['vat_type'] == $this->car)
            {
                $vat->car_vat_type = $data['vat_value_type'];
                $vat->car_vat_value = $data['vat_value'];
            }
            elseif ($data['vat_type'] == $this->package)
            {
                $vat->package_vat_type = $data['vat_value_type'];
                $vat->package_vat_value = $data['vat_value'];
            }

            if($vat->update())
            {
                return true;
            }
            return false;
        }


    }

}
