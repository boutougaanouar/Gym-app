<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Course;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function events(Request $request)
    {
        $start = Carbon::parse($request->get('start'));
        $end = Carbon::parse($request->get('end'));
        
        $events = [];

        // Créer un planning statique pour chaque jour dans la plage
        $period = CarbonPeriod::create($start, $end);
        
        foreach ($period as $date) {
            // Dimanche fermé
            if ($date->dayOfWeek === Carbon::SUNDAY) {
                $events[] = [
                    'id' => 'schedule_closed_' . $date->format('Y-m-d'),
                    'title' => 'Fermé - Dimanche',
                    'start' => $date->format('Y-m-d'),
                    'allDay' => true,
                    'backgroundColor' => '#ef4444',
                    'borderColor' => '#ef4444',
                    'textColor' => '#ffffff',
                    'display' => 'background',
                    'type' => 'closed',
                ];
            } else {
                // Calculer le type de public (alternance)
                $daysSinceStart = $date->diffInDays(Carbon::parse('2026-01-01'));
                $typePublic = $daysSinceStart % 2 === 0 ? 'homme' : 'femme';
                $color = $typePublic === 'homme' ? '#3b82f6' : '#ec4899';
                $icon = $typePublic === 'homme' ? 'fa-mars' : 'fa-venus';
                $label = $typePublic === 'homme' ? 'Journée Hommes' : 'Journée Femmes';
                
                $events[] = [
                    'id' => 'schedule_' . $date->format('Y-m-d'),
                    'title' => $label . ' - 08:00 à 22:00',
                    'start' => $date->format('Y-m-d'),
                    'allDay' => true,
                    'backgroundColor' => $color . '20',
                    'borderColor' => $color,
                    'textColor' => $color,
                    'type' => 'schedule',
                    'public' => $typePublic,
                    'icon' => $icon,
                ];
            }
        }

        // Récupérer les cours existants
        $courses = Course::with('coach')->whereBetween('date', [$start->format('Y-m-d'), $end->format('Y-m-d')])->get();
        
        foreach ($courses as $course) {
            $events[] = [
                'id' => 'course_' . $course->id,
                'title' => $course->titre . ($course->coach ? ' - ' . $course->coach->prenom . ' ' . $course->coach->nom : ''),
                'start' => $course->date->format('Y-m-d') . 'T' . $course->heure_debut->format('H:i:s'),
                'end' => $course->date->format('Y-m-d') . 'T' . $course->heure_fin->format('H:i:s'),
                'backgroundColor' => $course->couleur,
                'borderColor' => $course->couleur,
                'textColor' => '#ffffff',
                'type' => 'course',
                'description' => $course->description,
                'coach' => $course->coach,
                'max_participants' => $course->max_participants,
            ];
        }

        return response()->json($events);
    }

    public function generateSchedule(Request $request)
    {
        $start = Carbon::parse($request->get('start'));
        $end = Carbon::parse($request->get('end'));
        
        $period = CarbonPeriod::create($start, $end);
        $schedules = [];
        
        foreach ($period as $date) {
            // Dimanche fermé
            if ($date->dayOfWeek === Carbon::SUNDAY) {
                continue;
            }
            
            // Calculer le type de public (alternance)
            $daysSinceStart = $date->diffInDays(Carbon::parse('2026-01-01'));
            $typePublic = $daysSinceStart % 2 === 0 ? 'homme' : 'femme';
            
            Schedule::updateOrCreate(
                ['date' => $date->format('Y-m-d')],
                [
                    'type_public' => $typePublic,
                    'heure_ouverture' => '08:00:00',
                    'heure_fermeture' => '22:00:00',
                    'is_closed' => false,
                ]
            );
        }
        
        return response()->json(['message' => 'Planning généré avec succès']);
    }

    public function updateSchedule(Request $request, Schedule $schedule)
    {
        $request->validate([
            'type_public' => 'required|in:homme,femme',
            'heure_ouverture' => 'required|date_format:H:i',
            'heure_fermeture' => 'required|date_format:H:i|after:heure_ouverture',
            'is_closed' => 'boolean',
            'motif_fermeture' => 'required_if:is_closed,true|string|max:255',
        ]);

        $schedule->update($request->all());
        
        return response()->json(['message' => 'Planning mis à jour avec succès']);
    }

    public function getScheduleForDate($date)
    {
        $schedule = Schedule::with('courses')->byDate($date)->first();
        
        if (!$schedule) {
            // Créer automatiquement le planning pour cette date
            $carbonDate = Carbon::parse($date);
            $daysSinceStart = $carbonDate->diffInDays(Carbon::parse('2026-01-01'));
            $typePublic = $daysSinceStart % 2 === 0 ? 'homme' : 'femme';
            
            $schedule = Schedule::create([
                'date' => $date,
                'type_public' => $typePublic,
                'heure_ouverture' => '08:00:00',
                'heure_fermeture' => '22:00:00',
                'is_closed' => false,
            ]);
            
            $schedule->load('courses');
        }
        
        return response()->json($schedule);
    }
}
