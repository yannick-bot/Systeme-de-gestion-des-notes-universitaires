<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EC extends Model
{
    //
    /** @use HasFactory<\Database\Factories\EcFactory> */
    use HasFactory;
    protected $fillable = [
        'code',
        'nom',
        'coefficient',
        'ue_id'
    ];

    public function ue(): BelongsTo
    {
        return $this->belongsTo(UE::class);
    }
}
