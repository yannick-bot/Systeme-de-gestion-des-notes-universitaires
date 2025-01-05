<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{

    //
    protected $fillable = [
        'etudiant_id',
        'ec_id',
        'note',
        'session',
        'date_evaluation'
    ];

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function ec(): BelongsTo
    {
        return $this->belongsTo(EC::class, 'ec_id');
    }
}
