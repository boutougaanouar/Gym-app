<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Plan;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = Plan::all();
        
        $clients = [
            [
                'prenom' => 'Pierre',
                'nom' => 'Durand',
                'telephone' => '0611223344',
                'date_naissance' => '1990-05-15',
                'plan_id' => 1, // Plan Basic
                'date_debut' => '2026-01-01',
            ],
            [
                'prenom' => 'Sophie',
                'nom' => 'Lefebvre',
                'telephone' => '0622334455',
                'date_naissance' => '1985-08-22',
                'plan_id' => 2, // Plan Premium
                'date_debut' => '2026-01-05',
            ],
            [
                'prenom' => 'Lucas',
                'nom' => 'Petit',
                'telephone' => '0633445566',
                'date_naissance' => '1992-12-10',
                'plan_id' => 3, // Plan VIP
                'date_debut' => '2026-01-10',
            ],
            [
                'prenom' => 'Emma',
                'nom' => 'Robert',
                'telephone' => '0644556677',
                'date_naissance' => '1988-03-18',
                'plan_id' => 1, // Plan Basic
                'date_debut' => '2026-01-12',
            ],
            [
                'prenom' => 'Nicolas',
                'nom' => 'Richard',
                'telephone' => '0655667788',
                'date_naissance' => '1995-07-25',
                'plan_id' => 2, // Plan Premium
                'date_debut' => '2026-01-15',
            ],
            [
                'prenom' => 'Camille',
                'nom' => 'Dubois',
                'telephone' => '0666778899',
                'date_naissance' => '1991-11-30',
                'plan_id' => 3, // Plan VIP
                'date_debut' => '2026-01-18',
            ],
            [
                'prenom' => 'Antoine',
                'nom' => 'Moreau',
                'telephone' => '0677889900',
                'date_naissance' => '1987-09-14',
                'plan_id' => 1, // Plan Basic
                'date_debut' => '2026-01-20',
            ],
            [
                'prenom' => 'Léa',
                'nom' => 'Garcia',
                'telephone' => '0688990011',
                'date_naissance' => '1993-04-08',
                'plan_id' => 2, // Plan Premium
                'date_debut' => '2026-01-22',
            ],
            [
                'prenom' => 'David',
                'nom' => 'Lopez',
                'telephone' => '0699001122',
                'date_naissance' => '1989-06-21',
                'plan_id' => 1, // Plan Basic
                'date_debut' => '2026-01-25',
            ],
            [
                'prenom' => 'Julie',
                'nom' => 'Fontaine',
                'telephone' => '0600112233',
                'date_naissance' => '1994-02-12',
                'plan_id' => 3, // Plan VIP
                'date_debut' => '2026-01-28',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
