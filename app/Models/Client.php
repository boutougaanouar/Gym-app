<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Client extends Model
{
    protected $fillable = [
        'prenom',
        'nom',
        'telephone',
        'date_naissance',
        'plan_id',
        'date_debut',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function getMontantAPayerAttribute()
    {
        return $this->plan ? $this->plan->prix : 0;
    }

    public function getDateFinAttribute()
    {
        if (!$this->date_debut || !$this->plan) {
            return null;
        }
        
        return $this->date_debut->copy()->addMonths($this->plan->duree);
    }

    public function getStatutAttribute()
    {
        if (!$this->date_fin) {
            return 'Inactif';
        }
        
        return $this->date_fin->isFuture() ? 'Actif' : 'Expiré';
    }

    protected $appends = ['montant_a_payer', 'date_fin', 'statut'];
}
