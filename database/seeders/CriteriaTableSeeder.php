<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criteria;

class CriteriaTableSeeder extends Seeder
{
    public function run()
    {
        Criteria::create(['event_id' => '1','crt_name' => 'Relevance to the theme', 'crt_score' => '30',]);
        Criteria::create(['event_id' => '1','crt_name' => 'Costume and Props', 'crt_score' => '25',]);
        Criteria::create(['event_id' => '1','crt_name' => 'Performance (Mastery & Projection)', 'crt_score' => '20',]);
        Criteria::create(['event_id' => '1','crt_name' => 'Over-All Impact', 'crt_score' => '20',]);
        Criteria::create(['event_id' => '1','crt_name' => 'Audience Impact', 'crt_score' => '5',]);

        Criteria::create(['event_id' => '2','crt_name' => 'Figure', 'crt_score' => '30',]);
        Criteria::create(['event_id' => '2','crt_name' => 'Deportment', 'crt_score' => '20',]);
        Criteria::create(['event_id' => '2','crt_name' => 'Stage Presence', 'crt_score' => '20',]);
        Criteria::create(['event_id' => '2','crt_name' => 'Bearing', 'crt_score' => '15',]);
        Criteria::create(['event_id' => '2','crt_name' => 'Over-All Impact', 'crt_score' => '10',]);
        Criteria::create(['event_id' => '2','crt_name' => 'Audience Impact', 'crt_score' => '5',]);
        
        Criteria::create(['event_id' => '3','crt_name' => 'Elegance', 'crt_score' => '25',]);
        Criteria::create(['event_id' => '3','crt_name' => 'Figure', 'crt_score' => '25',]);
        Criteria::create(['event_id' => '3','crt_name' => 'Stage Presence', 'crt_score' => '20',]);
        Criteria::create(['event_id' => '3','crt_name' => 'Bearing', 'crt_score' => '15',]);
        Criteria::create(['event_id' => '3','crt_name' => 'Over-All Impact', 'crt_score' => '10',]);
        Criteria::create(['event_id' => '3','crt_name' => 'Audience Impact', 'crt_score' => '5',]);

        Criteria::create(['event_id' => '4','crt_name' => 'Poise Bearing', 'crt_score' => '25',]);
        Criteria::create(['event_id' => '4','crt_name' => 'Figure', 'crt_score' => '25',]);
        Criteria::create(['event_id' => '4','crt_name' => 'Elegance', 'crt_score' => '25',]);
        Criteria::create(['event_id' => '4','crt_name' => 'Deportment', 'crt_score' => '10',]);
        Criteria::create(['event_id' => '4','crt_name' => 'Over-All Impact', 'crt_score' => '10',]);
        Criteria::create(['event_id' => '4','crt_name' => 'Audience Impact', 'crt_score' => '5',]);

        Criteria::create(['event_id' => '5','crt_name' => 'Witt & Intelligence', 'crt_score' => '60',]);
        Criteria::create(['event_id' => '5','crt_name' => 'Beauty & Face', 'crt_score' => '40',]);

        
    }
}
