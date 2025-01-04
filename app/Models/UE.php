<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UE extends Model
{
    //
    /** @use HasFactory<\Database\Factories\UeFactory> */
    use HasFactory;
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
