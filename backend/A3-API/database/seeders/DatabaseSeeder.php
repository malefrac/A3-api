<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EnvironmentType;
use App\Models\Instructor;
use App\Models\LearningEnviroment;
use App\Models\User;
use Database\Factories\InstructorFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(CareerSeeder::class);
        $this->call(CourseSeeder::class); 
        $this->call(EnviromentTypeSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(LearningEnviromentSeeder::class);
        $this->call(SchedulingEnviromentSeeder::class);



       Instructor::factory()->create([
            'type' => 'Contratista',
            'profile' => 'Matematicas'
        ]);
        Instructor::factory()->create([
            'type' => 'Contratista',
            'profile' => 'Tics'
        ]);

        Instructor::factory()->create([
            'type' => 'Contratista',
            'profile' => 'Fisica'
        ]);

        Instructor::factory()->create([
            'type' => 'Planta',
            'profile' => 'Programación'
        ]);
        Instructor::factory()->create([
            'type' => 'Planta',
            'profile' => 'Ingles'
        ]); 

        User::factory(5)->create();
    }
}