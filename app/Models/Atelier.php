<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Atelier extends Model
{
    protected $fillable = [
        'titre',
        'slug',
        'description',
        'plat',
        'origine_pays',
        'prix',
        'duree_minutes',
        'max_participants',
        'photo',
        'statut',
    ];

    // Un atelier a plusieurs créneaux
    public function creneaux(): HasMany
    {
        return $this->hasMany(Creneau::class);
    }

    // Un atelier a plusieurs avis
    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class);
    }

    // Un atelier utilise plusieurs ingrédients
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'atelier_ingredient')
                    ->withPivot('quantite_necessaire');
    }

    // Calculer la note moyenne
    public function noteMoyenne(): float
    {
        return $this->avis()->where('est_visible', true)->avg('note') ?? 0;
    }
}