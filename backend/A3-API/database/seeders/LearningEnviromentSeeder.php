<?php

namespace Database\Seeders;

use App\Models\LearningEnviroment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningEnviromentSeeder extends Seeder
{
    public function run(): void
    {
       LearningEnviroment::insert([

        ['name' => 'Aula205' , 'capacity' => 31 , 'area_mt2' => 30, 
            'floor' => 2 , 'inventory' => '1 tv, 3 pc' , 'type_id' => 1 , 
            'location_id' => 1 , 'status' => 'INACTIVO'],
       ]); 
    }
}
