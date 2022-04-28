<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventTableSeeder extends Seeder
{
    public function run()
    {
        Event::create([ 'programs_id' => '1','event_name' => 'Goddess' ]);
        Event::create([ 'programs_id' => '1','event_name' => 'Swim Wear' ]); 
        Event::create([ 'programs_id' => '1','event_name' => 'Cocktail' ]); 
        Event::create([ 'programs_id' => '1','event_name' => 'Long Gown' ]); 
        Event::create([ 'programs_id' => '1','event_name' => 'Preliminary Q and A' ]); 
    }
}
