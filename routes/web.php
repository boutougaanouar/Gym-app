<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('plans', PlanController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('coaches', CoachController::class);
    
    // Routes pour le calendrier
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events');
    Route::post('/calendar/generate', [CalendarController::class, 'generateSchedule'])->name('calendar.generate');
    Route::get('/calendar/schedule/{date}', [CalendarController::class, 'getScheduleForDate'])->name('calendar.schedule');
    Route::put('/calendar/schedule/{schedule}', [CalendarController::class, 'updateSchedule'])->name('calendar.schedule.update');
    
    // Routes pour les cours (API + CRUD)
    Route::apiResource('courses', CourseController::class);
    Route::get('/api/coaches', function() {
        return response()->json(\App\Models\Coach::all());
    });
});

require __DIR__.'/auth.php';
