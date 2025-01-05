<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    protected $model = Etudiant::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'numero_etudiant' => $this->faker->unique()->numerify('ETU###'),
            'niveau' => $this->faker->randomElement(['L1', 'L2', 'L3']),
        ];
    }
}
