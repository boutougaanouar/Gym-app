<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Plan;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('plan')->orderBy('nom')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $plans = Plan::orderBy('nom')->get();
        return view('clients.create', compact('plans'));
    }

    public function store(ClientRequest $request)
    {
        Client::create($request->validated());
        
        return redirect()->route('clients.index')
            ->with('success', 'Client créé avec succès.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Client $client)
    {
        $plans = Plan::orderBy('nom')->get();
        return view('clients.edit', compact('client', 'plans'));
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        
        return redirect()->route('clients.index')
            ->with('success', 'Client mis à jour avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        
        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}
