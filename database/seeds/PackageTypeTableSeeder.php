<?php

use Illuminate\Database\Seeder;
use App\PackageType;
class PackageTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $package_type = [
          [
              'type'=>'Flight'
          ],
          [
              'type'=>'Hotel'
          ]
      ];

      PackageType::truncate();
      foreach ($package_type as $key => $value){
        PackageType::create($value);
      }
    }
}
