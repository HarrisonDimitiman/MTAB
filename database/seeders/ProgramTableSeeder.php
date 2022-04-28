<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramTableSeeder extends Seeder
{
    public function run()
    {
        Program::create(['name' => 'Brgy. Maria Cristina Beauty Pageant', 'date' => '2022-4-30' ]); 
    }
}
