<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Course extends Model
{
    protected $fillable = [
        'titre',
        'date',
        'heure_debut',
        'heure_fin',
        'description',
        'coach_id',
        'couleur',
        'max_participants',
    ];

    protected $casts = [
        'date' => 'date',
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
        'max_participants' => 'integer',
    ];

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class);
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->date->format('d/m/Y');
    }

    public function getFormattedTimeAttribute(): string
    {
        return $this->heure_debut->format('H:i') . ' - ' . $this->heure_fin->format('H:i');
    }

    public function getDurationAttribute(): int
    {
        return $this->heure_debut->diffInMinutes($this->heure_fin);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function scopeBetweenDates($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end]);
    }

    public function scopeWithCoach($query)
    {
        return $query->with('coach');
    }

    public function overlapsWith($heureDebut, $heureFin): bool
    {
        return ($this->heure_debut < $heureFin) && ($heureFin > $this->heure_debut);
    }
}
