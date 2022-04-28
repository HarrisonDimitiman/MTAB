<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {        
        $this->call([
            UserAndRoleTableSeeder::class,
            ProgramTableSeeder::class,      
            EventTableSeeder::class,
            CriteriaTableSeeder::class,
        ]);
    }
}
