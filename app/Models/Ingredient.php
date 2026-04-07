<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    protected $fillable = [
        'nom',
        'unite',
        'quantite_stock',
        'seuil_alerte',
    ];

    // Un ingrédient est utilisé dans plusieurs ateliers
    public function ateliers(): BelongsToMany
    {
        return $this->belongsToMany(Atelier::class, 'atelier_ingredient')
                    ->withPivot('quantite_necessaire');
    }

    // Vérifier si le stock est bas
    public function stockBas(): bool
    {
        return $this->quantite_stock <= $this->seuil_alerte;
    }
}