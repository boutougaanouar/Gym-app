<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Plan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        
        $clients = Client::with('plan')->get();
        
        $abonnementsActifs = $clients->filter(function($client) {
            return $client->statut === 'Actif';
        })->count();
        
        $abonnementsExpires = $clients->filter(function($client) {
            return $client->statut === 'Expiré';
        })->count();
        
        $revenusTotaux = $clients->sum(function($client) {
            return $client->montant_a_payer;
        });

        return view('dashboard', compact(
            'totalClients',
            'abonnementsActifs', 
            'abonnementsExpires',
            'revenusTotaux'
        ));
    }
}
