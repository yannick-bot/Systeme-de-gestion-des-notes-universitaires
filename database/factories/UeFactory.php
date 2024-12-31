<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UE>
 */
class UeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'code' => fake()->text(4),
            'nom' =>  fake()->text(),
            'credits_ects' => fake()->numberBetween(-PHP_INT_MAX, PHP_INT_MAX),
            'semestre' => fake()->numberBetween(-PHP_INT_MAX, PHP_INT_MAX)
        ];
    }
}
