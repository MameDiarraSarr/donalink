<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $fillable = [
        'don_id',
        'beneficiaire_id',
        'date_distribution',
        'notes',
    ];

    public function don()
    {
        return $this->belongsTo(Don::class);
    }

    public function beneficiaire()
    {
        return $this->belongsTo(Beneficiaire::class);
    }
}
