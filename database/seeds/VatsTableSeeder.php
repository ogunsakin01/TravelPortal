<?php

use Illuminate\Database\Seeder;
use App\Vat;

class VatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vat = [
                'id' => 1,
                'flight_vat_type'   => 2,
                'flight_vat_value'  => 1,
                'hotel_vat_type'    => 2,
                'hotel_vat_value'   => 1,
                'car_vat_type'      => 2,
                'car_vat_value'     => 1,
                'package_vat_type'  => 2,
                'package_vat_value' => 1
        ];

        Vat::create($vat);
    }
}
