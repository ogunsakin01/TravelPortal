<?php

use Illuminate\Database\Seeder;
use App\Title;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [
            [
                'name' => 'Mr'
            ],

            [
                'name' => 'Mrs'
            ],

            [
                'name' => 'Miss'
            ],

            [
                'name' => 'Master'
            ]
        ];

        foreach($titles as $key => $value)
        {
            Title::create($value);
        }
    }
}
