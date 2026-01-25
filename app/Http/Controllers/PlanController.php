<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::orderBy('nom')->get();
        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(PlanRequest $request)
    {
        Plan::create($request->validated());
        
        return redirect()->route('plans.index')
            ->with('success', 'Plan créé avec succès.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Plan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    public function update(PlanRequest $request, Plan $plan)
    {
        $plan->update($request->validated());
        
        return redirect()->route('plans.index')
            ->with('success', 'Plan mis à jour avec succès.');
    }

    public function destroy(Plan $plan)
    {
        if ($plan->clients()->count() > 0) {
            return redirect()->route('plans.index')
                ->with('error', 'Impossible de supprimer ce plan car il est utilisé par des clients.');
        }
        
        $plan->delete();
        
        return redirect()->route('plans.index')
            ->with('success', 'Plan supprimé avec succès.');
    }
}
