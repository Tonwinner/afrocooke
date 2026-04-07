<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avis extends Model
{
    protected $fillable = [
        'user_id',
        'atelier_id',
        'note',
        'commentaire',
        'est_visible',
    ];

    // Un avis appartient à un client
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Un avis concerne un atelier
    public function atelier(): BelongsTo
    {
        return $this->belongsTo(Atelier::class);
    }
}