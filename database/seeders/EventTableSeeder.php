<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventTableSeeder extends Seeder
{
    public function run()
    {
        Event::create([ 
            'programs_id' => '1',
            'event_name' => 'Goddess',
            'percentage' => '0.25',
        ]);
        Event::create([ 
            'programs_id' => '1',
            'event_name' => 'Swim Wear',
            'percentage' => '0.15',
        ]); 
        Event::create([ 
            'programs_id' => '1',
            'event_name' => 'Cocktail',
            'percentage' => '0.15',
        ]); 
        Event::create([ 
            'programs_id' => '1',
            'event_name' => 'Long Gown',
            'percentage' => '0.15',
         ]); 
        Event::create([ 
            'programs_id' => '1',
            'event_name' => 'Preliminary Q and A',
            'percentage' => '0.30',
         ]); 
    }
}
