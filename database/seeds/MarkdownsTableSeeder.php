<?php

use Illuminate\Database\Seeder;
use App\Markdown;

class MarkdownsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $markdowns = [
            [
                'id'           => 1,
                'airline_code' => 'AF',
                'type'         => 1,
                'value'        => 7000
            ],
            [
                'id'           => 2,
                'airline_code' => 'BA',
                'type'         => 1,
                'value'        => 20000
            ],
            [
                'id'           => 3,
                'airline_code' => 'BI',
                'type'         => 1,
                'value'        => 30000
            ],
            [
                'id'           => 4,
                'airline_code' => 'EK',
                'type'         => 1,
                'value'        => 3000
            ],
            [
                'id'           => 5,
                'airline_code' => 'TK',
                'type'         => 1,
                'value'        => 40000
            ],
            [
                'id'           => 6,
                'airline_code' => 'LH',
                'type'         => 1,
                'value'        => 6000
            ]
        ];
        foreach($markdowns as $serial => $markdown){
            Markdown::create($markdown);
        }

    }
}
