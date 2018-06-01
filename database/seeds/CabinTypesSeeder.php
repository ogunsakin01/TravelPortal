<?php

use Illuminate\Database\Seeder;
use App\CabinType;

class CabinTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cabin_type = [
            [
                'cabin_code' => 'Y',
                'cabin_name'=>'Economy'
            ],
            [
                'cabin_code'=> 'S',
                'cabin_name' => 'Premium Economy'
            ],
            [
                'cabin_code'=> 'C',
                'cabin_name' => 'Business'
            ],
            [
                'cabin_code'=> 'J',
                'cabin_name' => 'Premium Business'
            ],
            [
                'cabin_code'=> 'F',
                'cabin_name' => 'First'
            ],
            [
                'cabin_code'=> 'P',
                'cabin_name' => 'Premium First'
            ]
        ];
        foreach ($cabin_type as $key => $value){
            CabinType::create($value);
        }
    }
}
