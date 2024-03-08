<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    
    public function run(): void
    {
        Career::insert([

            ['name' => 'Programación de Software', 'type' => 'Tecnico' ],
            ['name' => 'Analisis y Desarrolo de Software' , 'type' => 'Tecnologo'],
            ['name' => 'Apoyo Administrativo en Salud' , 'type' => 'Tecnico'],
            ['name' => 'Gestión Documental' , 'type' => 'Tecnologo']

        ]);
    }
}
