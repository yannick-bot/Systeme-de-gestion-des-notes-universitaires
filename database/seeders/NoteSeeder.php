<?php
namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\Note;
use App\Models\EC;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Trouver quelques étudiants
        $etudiant1 = Etudiant::find(1);
        $etudiant2 = Etudiant::find(2);
        $etudiant3 = Etudiant::find(3);

        if (!$etudiant1 || !$etudiant2 || !$etudiant3) {
            echo "Erreur: Un ou plusieurs étudiants n'ont pas été trouvés.\n";
            return;
        }

        // Trouver quelques ECs (éléments constitutifs)
        $ec1 = EC::find(1);
        $ec2 = EC::find(2);

        if (!$ec1 || !$ec2) {
            echo "Erreur: Un ou plusieurs éléments constitutifs n'ont pas été trouvés.\n";
            return;
        }

        // Ajouter des notes pour l'étudiant 1
        $etudiant1->notes()->create([
            'ec_id' => $ec1->id,
            'note' => 15.5,
            'session' => 'normale',
            'date_evaluation' => Carbon::now()->toDateString(),
        ]);

        $etudiant1->notes()->create([
            'ec_id' => $ec2->id,
            'note' => 18.0,
            'session' => 'normale',
            'date_evaluation' => Carbon::now()->toDateString(),
        ]);

        // Ajouter des notes pour l'étudiant 2
        $etudiant2->notes()->create([
            'ec_id' => $ec1->id,
            'note' => 12.0,
            'session' => 'rattrapage',
            'date_evaluation' => Carbon::now()->toDateString(),
        ]);

        $etudiant2->notes()->create([
            'ec_id' => $ec2->id,
            'note' => 14.5,
            'session' => 'rattrapage',
            'date_evaluation' => Carbon::now()->toDateString(),
        ]);

        // Ajouter des notes pour l'étudiant 3
        $etudiant3->notes()->create([
            'ec_id' => $ec1->id,
            'note' => 17.0,
            'session' => 'normale',
            'date_evaluation' => Carbon::now()->toDateString(),
        ]);

        $etudiant3->notes()->create([
            'ec_id' => $ec2->id,
            'note' => 16.5,
            'session' => 'normale',
            'date_evaluation' => Carbon::now()->toDateString(),
        ]);
    }
}
