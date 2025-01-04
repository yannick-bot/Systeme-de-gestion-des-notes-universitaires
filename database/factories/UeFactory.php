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
            'code' => fake()->lexify('????'),
            'nom' =>  fake()->text(),
            'credits_ects' => fake()->numberBetween(-128, 127),
            'semestre' => fake()->numberBetween(-128, 127)
        ];
    }
}
