<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    protected $fillable = [
        'user_id',
        'campagne_id',
        'type',
        'montant',
        'description_materiel',
        'quantite',
        'mode_paiement',
        'anonyme',
        'statut',
    ];

    public function campagne()
    {
        return $this->belongsTo(Campagne::class);
    }

    public function distribution()
    {
        return $this->hasOne(Distribution::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
