<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CodePromo extends Model
{
    protected $table = 'code_promos';
    protected $fillable = [
        'code',
        'type_reduction',
        'valeur',
        'date_debut',
        'date_fin',
        'usage_max',
        'usage_actuel',
        'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    // Un code promo peut être utilisé dans plusieurs réservations
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // Vérifier si le code est encore valide
    public function estValide(): bool
    {
        return $this->statut === 'actif'
            && now()->between($this->date_debut, $this->date_fin)
            && $this->usage_actuel < $this->usage_max;
    }

    // Calculer la réduction sur un montant
    public function calculerReduction(float $montant): float
    {
        if ($this->type_reduction === 'pourcentage') {
            return $montant * ($this->valeur / 100);
        }

        return min($this->valeur, $montant);
    }
}