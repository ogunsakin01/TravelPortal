<?php

use Illuminate\Database\Seeder;
use App\MarkupValueType;

class MarkupValueTypesTableSeeder extends Seeder
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
                'type' => 'Naira'
            ],

            [
                'type' => 'Percentage'
            ],
        ];

        foreach ($markups as $key => $value)
        {
            MarkupValueType::create($value);
        }
    }
}
