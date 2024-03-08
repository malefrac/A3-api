<?php

namespace Database\Seeders;

use App\Models\SchedulingEnviroment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchedulingEnviromentSeeder extends Seeder
{
    public function run(): void
    {
       SchedulingEnviroment::insert([

        ['course_id' => 1 , 'instructor_id' => 1 , 'date_scheduling' => '2024-01-30', 
            'initial_hour' => '08:00:00' , 'final_hour' => '12:00:00' , 'enviroment_id' => 1],
       ]); 
    }
}
