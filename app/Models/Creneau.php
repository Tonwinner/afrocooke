<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Creneau extends Model
{
    protected $table = 'creneaux';

    protected $fillable = [
        'atelier_id',
        'chef_id',
        'date',
        'heure_debut',
        'heure_fin',
        'places_restantes',
        'statut',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }

    /**
     * Utiliser uuid dans les URLs publiques.
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function atelier(): BelongsTo
    {
        return $this->belongsTo(Atelier::class);
    }

    public function chef(): BelongsTo
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function estDisponible(): bool
    {
        return $this->places_restantes > 0 && $this->statut === 'disponible';
    }
}