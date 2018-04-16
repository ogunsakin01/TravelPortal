<?php

use Illuminate\Database\Seeder;
use App\Markup;

class MarkupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $markups = [
          [
              'id'   => 1,
              'role_id' => 2,
              'flight_markup_type' => 1,
              'flight_markup_value' => 10000,
              'hotel_markup_type' => 1,
              'hotel_markup_value' => 10000,
              'car_markup_type' => 1,
              'car_markup_value' => 10000,
              'package_markup_type' => 1,
              'package_markup_value' => 10000,
          ],
          [
              'id'   => 2,
              'role_id' => 3,
              'flight_markup_type' => 1,
              'flight_markup_value' => 10000,
              'hotel_markup_type' => 1,
              'hotel_markup_value' => 10000,
              'car_markup_type' => 1,
              'car_markup_value' => 10000,
              'package_markup_type' => 1,
              'package_markup_value' => 10000,
          ]
      ];

      foreach($markups as $serial => $markup){
          Markup::create($markup);
      }
    }
}
