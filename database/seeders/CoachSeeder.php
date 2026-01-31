<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coach;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coaches = [
            [
                'prenom' => 'Jean',
                'nom' => 'Dupont',
                'telephone' => '0612345678',
                'specialite' => 'Musculation',
                'biographie' => 'Coach certifié avec 10 ans d\'expérience en musculation et préparation physique.',
            ],
            [
                'prenom' => 'Marie',
                'nom' => 'Martin',
                'telephone' => '0623456789',
                'specialite' => 'Yoga',
                'biographie' => 'Professeure de yoga diplômée, spécialisée en Hatha et Vinyasa yoga.',
            ],
            [
                'prenom' => 'Thomas',
                'nom' => 'Bernard',
                'telephone' => '0634567890',
                'specialite' => 'CrossFit',
                'biographie' => 'Coach CrossFit niveau 3, passionné par les entraînements intensifs et fonctionnels.',
            ],
        ];

        foreach ($coaches as $coach) {
            Coach::create($coach);
        }
    }
}
