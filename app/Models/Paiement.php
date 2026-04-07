<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    protected $fillable = [
        'reservation_id',
        'montant',
        'methode',
        'transaction_id',
        'statut',
        'date_paiement',
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
    ];

    // Un paiement appartient à une réservation
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    // Vérifier si le paiement est réussi
    public function estReussi(): bool
    {
        return $this->statut === 'reussi';
    }
}