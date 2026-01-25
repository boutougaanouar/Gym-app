<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'description' => 'nullable|string',
            'coach_id' => 'nullable|integer',
            'couleur' => 'required|string',
            'max_participants' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du cours est obligatoire',
            'titre.max' => 'Le titre ne peut pas dépasser 255 caractères',
            'date.required' => 'La date est obligatoire',
            'date.after_or_equal' => 'La date doit être aujourd\'hui ou dans le futur',
            'heure_debut.required' => 'L\'heure de début est obligatoire',
            'heure_debut.date_format' => 'L\'heure de début doit être au format HH:MM',
            'heure_fin.required' => 'L\'heure de fin est obligatoire',
            'heure_fin.date_format' => 'L\'heure de fin doit être au format HH:MM',
            'heure_fin.after' => 'L\'heure de fin doit être après l\'heure de début',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères',
            'coach_id.exists' => 'Le coach sélectionné n\'existe pas',
            'couleur.required' => 'La couleur est obligatoire',
            'couleur.regex' => 'La couleur doit être au format hexadécimal (#RRGGBB)',
            'max_participants.min' => 'Le nombre maximum de participants doit être au moins 1',
            'max_participants.max' => 'Le nombre maximum de participants ne peut pas dépasser 100',
        ];
    }

    protected function prepareForValidation()
    {
        // Validation personnalisée pour vérifier que la durée n'est pas trop longue
        if ($this->has('heure_debut') && $this->has('heure_fin')) {
            $debut = Carbon::parse($this->heure_debut);
            $fin = Carbon::parse($this->heure_fin);
            $duration = $debut->diffInMinutes($fin);
            
            if ($duration > 480) { // 8 heures maximum
                $this->validator->after(function ($validator) {
                    $validator->errors()->add('heure_fin', 'Un cours ne peut pas durer plus de 8 heures');
                });
            }
            
            if ($duration < 15) { // 15 minutes minimum
                $this->validator->after(function ($validator) {
                    $validator->errors()->add('heure_fin', 'Un cours doit durer au moins 15 minutes');
                });
            }
        }
    }
}
