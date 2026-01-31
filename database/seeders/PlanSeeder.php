<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'nom' => 'Plan Basic',
                'description' => 'Accès aux équipements de base pendant 1 mois',
                'prix' => 600,
                'duree' => 3,
            ],
            [
                'nom' => 'Plan Premium',
                'description' => 'Accès complet à tous les équipements et cours collectifs pendant 3 mois',
                'prix' => 1500,
                'duree' => 9,
            ],
            [
                'nom' => 'Plan VIP',
                'description' => 'Accès illimité avec coach personnel et services premium pendant 6 mois',
                'prix' => 2000,
                'duree' => 12,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
