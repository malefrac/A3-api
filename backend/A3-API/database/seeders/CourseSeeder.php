<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
       Course::insert([

        ['code' => 2771230 , 'shift' => 'Diurna' , 'career_id' => 1, 
            'initial_date' => '2023-08-15' , 'final_date' => '2024-10-04' , 'status' => 'Lectiva'],
        ['code' => 2339817 , 'shift' => 'Mixta' , 'career_id' => 2, 
            'initial_date' => '2022-01-15' , 'final_date' => '2023-06-15' , 'status' => 'Productiva'],
        ['code' => 1838890 , 'shift' => 'Nocturna' , 'career_id' => 3, 
            'initial_date' => '2024-01-20' , 'final_date' => '2025-06-20' , 'status' => 'Inducción']

       ]); 
    }
}
