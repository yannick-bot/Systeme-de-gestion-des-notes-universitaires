<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UE;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EC>
 */
class EcFactory extends Factory
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
            'nom' => fake()->text(),
            'coefficient' => fake()->numberBetween(-PHP_INT_MAX, PHP_INT_MAX),
            'ue_id' => UE::factory()
        ];
    }
}
