<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

use Venue\Models\Venue;

class VenueSeeder extends Seeder
{

    public function run()
    {
        $venues = [
            [
                'title' => 'Big Hall',
                'description' => 'Big Hall',
                'price'=>30000
            ],
            [
                'title' => 'Opera Hall',
                'description' => 'Opera Hall',
                'price'=>20000
            ],
            [
                'title' => 'Small Hall',
                'description' => 'Small Hall',
                'price'=>10000
            ],
            [
                'title' => 'Side Hall',
                'description' => 'Side Hall',
                'price'=>5000
            ],
            [
                'title' => 'Open Hall',
                'description' => 'Open Hall',
                'price'=>3000
            ]
        ];

        foreach($venues as $item){
            $venue = Venue::create($item);
        }
    }
}
