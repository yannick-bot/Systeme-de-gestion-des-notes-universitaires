<?php

namespace Database\Seeders;

use App\Models\UE;
use App\Models\EC;
use Illuminate\Database\Seeder;

class UEECSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ajouter des UE
        $ue1 = UE::create([
            'code' => 'UE01',
            'nom' => 'Mathématiques et Sciences',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $ue2 = UE::create([
            'code' => 'UE02',
            'nom' => 'Informatique et Algorithmique',
            'credits_ects' => 5,
            'semestre' => 2,
        ]);

        // Ajouter des EC et les lier aux UE
        $ec1 = EC::create([
            'code' => 'EC01',
            'nom' => 'Mathématiques',
            'coefficient' => 3,
            'ue_id' => $ue1->id, // Associer à l'UE1
        ]);

        $ec2 = EC::create([
            'code' => 'EC02',
            'nom' => 'Physique',
            'coefficient' => 3,
            'ue_id' => $ue1->id, // Associer à l'UE1
        ]);

        $ec3 = EC::create([
            'code' => 'EC03',
            'nom' => 'Informatique',
            'coefficient' => 2,
            'ue_id' => $ue2->id, // Associer à l'UE2
        ]);

        $ec4 = EC::create([
            'code' => 'EC04',
            'nom' => 'Algorithmique',
            'coefficient' => 3,
            'ue_id' => $ue2->id, // Associer à l'UE2
        ]);
    }
}
