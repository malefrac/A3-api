<?php

namespace Database\Seeders;

use App\Models\EnviromentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnviromentTypeSeeder extends Seeder
{
    
    public function run(): void
    {
        EnviromentType::insert([

            ['description' => 'Aula'],
            ['description' => 'Taller'],
            ['description' => 'LAboratorio'],
            ['description' => 'Aula Virtual'],
            ['description' => 'Auditorio'],
            ['description' => 'Biblioteca'],
            ['description' => 'Campo Deportivo']

        ]);
    }
}
