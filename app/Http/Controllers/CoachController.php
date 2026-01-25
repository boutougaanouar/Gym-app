<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoachRequest;
use App\Models\Coach;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::orderBy('nom')->get();
        return view('coaches.index', compact('coaches'));
    }

    public function create()
    {
        return view('coaches.create');
    }

    public function store(CoachRequest $request)
    {
        Coach::create($request->validated());
        
        return redirect()->route('coaches.index')
            ->with('success', 'Coach créé avec succès.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Coach $coach)
    {
        return view('coaches.edit', compact('coach'));
    }

    public function update(CoachRequest $request, Coach $coach)
    {
        $coach->update($request->validated());
        
        return redirect()->route('coaches.index')
            ->with('success', 'Coach mis à jour avec succès.');
    }

    public function destroy(Coach $coach)
    {
        $coach->delete();
        
        return redirect()->route('coaches.index')
            ->with('success', 'Coach supprimé avec succès.');
    }
}
