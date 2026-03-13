<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiaire extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'adresse',
        'besoins',
    ];

    public function distributions()
    {
        return $this->hasMany(Distribution::class);
    }
}
