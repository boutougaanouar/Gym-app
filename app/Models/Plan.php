<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'duree',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
