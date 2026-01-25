<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Models\Coach;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('coach')->orderBy('date')->orderBy('heure_debut')->paginate(20);
        return response()->json($courses);
    }

    public function create()
    {
        $coaches = Coach::all();
        return response()->json($coaches);
    }

    public function store(StoreCourseRequest $request)
    {
        try {
            $validated = $request->validated();
            
            // Vérifier que la date n'est pas un dimanche
            $date = Carbon::parse($validated['date']);
            if ($date->dayOfWeek === Carbon::SUNDAY) {
                return response()->json(['error' => 'Les cours ne peuvent pas être programmés le dimanche'], 422);
            }
            
            // Vérifier les chevauchements avec d'autres cours
            $existingCourses = Course::where('date', $validated['date'])->get();
            
            $heureDebut = Carbon::parse($validated['heure_debut']);
            $heureFin = Carbon::parse($validated['heure_fin']);
            
            foreach ($existingCourses as $existingCourse) {
                if ($existingCourse->overlapsWith($heureDebut, $heureFin)) {
                    return response()->json(['error' => 'Ce cours chevauche avec un autre cours : ' . $existingCourse->titre], 422);
                }
            }
            
            $course = Course::create($validated);
            
            return response()->json([
                'message' => 'Cours créé avec succès',
                'course' => $course->load('coach')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la création du cours: ' . $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTrace() : null
            ], 500);
        }
    }

    public function show(Course $course)
    {
        return response()->json($course->load('coach'));
    }

    public function edit(Course $course)
    {
        $coaches = Coach::all();
        return response()->json([
            'course' => $course->load('coach'),
            'coaches' => $coaches
        ]);
    }

    public function update(StoreCourseRequest $request, Course $course)
    {
        try {
            $validated = $request->validated();
            
            // Vérifier que la date n'est pas un dimanche
            $date = Carbon::parse($validated['date']);
            if ($date->dayOfWeek === Carbon::SUNDAY) {
                return response()->json(['error' => 'Les cours ne peuvent pas être programmés le dimanche'], 422);
            }
            
            // Vérifier les chevauchements avec d'autres cours (en excluant le cours actuel)
            $existingCourses = Course::where('date', $validated['date'])
                                    ->where('id', '!=', $course->id)
                                    ->get();
            
            $heureDebut = Carbon::parse($validated['heure_debut']);
            $heureFin = Carbon::parse($validated['heure_fin']);
            
            foreach ($existingCourses as $existingCourse) {
                if ($existingCourse->overlapsWith($heureDebut, $heureFin)) {
                    return response()->json(['error' => 'Ce cours chevauche avec un autre cours : ' . $existingCourse->titre], 422);
                }
            }
            
            $course->update($validated);
            
            return response()->json([
                'message' => 'Cours mis à jour avec succès',
                'course' => $course->load('coach')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la mise à jour du cours: ' . $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTrace() : null
            ], 500);
        }
    }

    public function destroy(Course $course)
    {
        $course->delete();
        
        return response()->json([
            'message' => 'Cours supprimé avec succès'
        ]);
    }
}
