<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Schedule extends Model
{
    protected $fillable = [
        'date',
        'type_public',
        'heure_ouverture',
        'heure_fermeture',
        'is_closed',
        'motif_fermeture',
    ];

    protected $casts = [
        'date' => 'date',
        'heure_ouverture' => 'datetime:H:i',
        'heure_fermeture' => 'datetime:H:i',
        'is_closed' => 'boolean',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'date', 'date');
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->date->format('d/m/Y');
    }

    public function getJourSemaineAttribute(): string
    {
        return ucfirst($this->date->locale('fr')->dayName);
    }

    public function getPublicLabelAttribute(): string
    {
        return $this->type_public === 'homme' ? 'Hommes' : 'Femmes';
    }

    public function getPublicColorAttribute(): string
    {
        return $this->type_public === 'homme' ? '#3b82f6' : '#ec4899';
    }

    public function getPublicIconAttribute(): string
    {
        return $this->type_public === 'homme' ? 'fa-mars' : 'fa-venus';
    }

    public function scopeOpen($query)
    {
        return $query->where('is_closed', false);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function scopeBetweenDates($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end]);
    }
}
