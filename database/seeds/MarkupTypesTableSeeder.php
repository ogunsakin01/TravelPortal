<?php

use Illuminate\Database\Seeder;
use App\MarkupType;

class MarkupTypesTableSeeder extends Seeder
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
                'type' => 'Flight'
            ],

            [
                'type' => 'Hotel'
            ],

            [
                'type' => 'Car'
            ],

            [
                'type' => 'Package'
            ]
        ];

        foreach ($markups as $key => $value)
        {
            MarkupType::create($value);
        }

    }
}
