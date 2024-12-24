<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etudiant extends Model
{
    //
    protected $fillable = [
        'numero_etudiant',
        'nom',
        'prenom',
        'niveau',
    ];

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
