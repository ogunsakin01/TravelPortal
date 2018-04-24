<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Markup extends Model
{
    public $flight = 1;
    public $hotel = 2;
    public $car = 3;
    public $package = 4;


    public static function getAdminUserMarkup()
    {
        return static::where('role_id', 1)->first();
    }

    public static function getAdminAgentMarkup(){
        return static::where('role_id', 2)->first();
    }

    public function updateOrCreateMarkup($data)
    {
        $markup = static::where('role_id', $data['role'])->first();

        if (is_null($markup))
        {
            $markup = new static();
            $markup->user_id = auth()->id();
            $markup->role_id = $data['role'];

            if ($data['markup_type'] == $this->flight)
            {
                $markup->flight_markup_type = $data['markup_value_type'];
                $markup->flight_markup_value = $data['markup_value'];
            }
            elseif ($data['markup_type'] == $this->hotel)
            {
                $markup->hotel_markup_type = $data['markup_value_type'];
                $markup->hotel_markup_value = $data['markup_value'];
            }
            elseif ($data['markup_type'] == $this->car)
            {
                $markup->car_markup_type = $data['markup_value_type'];
                $markup->car_markup_value = $data['markup_value'];
            }
            elseif ($data['markup_type'] == $this->package)
            {
                $markup->package_markup_type = $data['markup_value_type'];
                $markup->package_markup_value = $data['markup_value'];
            }

            if ($markup->save())
            {
                return true;
            }
            return false;
        }
        else
        {
            if ($data['markup_type'] == $this->flight)
            {
                $markup->flight_markup_type = $data['markup_value_type'];
                $markup->flight_markup_value = $data['markup_value'];
            }
            elseif ($data['markup_type'] == $this->hotel)
            {
                $markup->hotel_markup_type = $data['markup_value_type'];
                $markup->hotel_markup_value = $data['markup_value'];
            }
            elseif ($data['markup_type'] == $this->car)
            {
                $markup->car_markup_type = $data['markup_value_type'];
                $markup->car_markup_value = $data['markup_value'];
            }
            elseif ($data['markup_type'] == $this->package)
            {
                $markup->package_markup_type = $data['markup_value_type'];
                $markup->package_markup_value = $data['markup_value'];
            }

            if($markup->update())
            {
                return true;
            }
            return false;
        }
    }

    public function fetchAuthenticatedUserMarkup()
    {
        $markup = static::where('user_id', auth()->id)->get();

    }
}
