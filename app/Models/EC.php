<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EC extends Model
{
    //
    protected $fillable = [
        'code',
        'nom',
        'coefficient',
    ];

    public function ue(): BelongsTo
    {
        return $this->belongsTo(UE::class);
    }
}
