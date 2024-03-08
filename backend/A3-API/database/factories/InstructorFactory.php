<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{

    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
        'document' => fake() ->unique()->numberBetween(1000000000 , 9999999999),
        'fullname'=> fake() ->name(),
        'sena_email'=> fake() ->unique()->safeEmail(),
        'personal_email'=> fake() ->unique()->safeEmail(),
        'phone' => fake() ->phoneNumber(),
        'password' => static::$password ??= Hash::make('password'),
        ];
    }
}