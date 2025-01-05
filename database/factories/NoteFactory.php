<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition()
    {
        return [
            'etudiant_id' => \App\Models\Etudiant::factory(),
            'ec_id' => \App\Models\EC::factory(),
            'note' => $this->faker->randomFloat(2, 0, 20), // Génère une note entre 0 et 20
        ];
    }
}
