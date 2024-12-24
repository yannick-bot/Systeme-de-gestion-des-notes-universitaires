<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Model;

class UE extends Model
{
    //
    protected $fillable = [
        'code',
        'nom',
        'credits_ects',
        'semestre',
    ];

    public function ec(): HasMany
    {
        return $this->hasMany(EC::class);
    }
}
