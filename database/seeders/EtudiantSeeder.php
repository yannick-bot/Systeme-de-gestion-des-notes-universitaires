<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use Illuminate\Database\Seeder;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ajouter plusieurs étudiants à la base de données
        Etudiant::create([
            'numero_etudiant' => '2025001',
            'nom' => 'Dupont',
            'prenom' => 'Pierre',
            'niveau' => 'L1',
        ]);

        Etudiant::create([
            'numero_etudiant' => '2025002',
            'nom' => 'Lemoine',
            'prenom' => 'Sophie',
            'niveau' => 'L2',
        ]);

        Etudiant::create([
            'numero_etudiant' => '2025003',
            'nom' => 'Martin',
            'prenom' => 'Lucas',
            'niveau' => 'L3',
        ]);

        // Ajouter d'autres étudiants si nécessaire
    }
}
