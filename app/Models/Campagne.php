<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campagne extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'type',
        'objectif_montant',
        'montant_collecte',
        'statut',
        'date_fin',
        'image',
    ];

    public function dons()
    {
        return $this->hasMany(Don::class);
    }
}
