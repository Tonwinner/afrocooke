<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'creneau_id',
        'code_promo_id',
        'nombre_personnes',
        'montant_total',
        'statut',
        'notes',
    ];

    /**
     * Générer un UUID automatiquement à la création.
     * boot() est appelé une seule fois au démarrage du model.
     */
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
     * Utiliser uuid au lieu de id dans les URLs.
     * Laravel utilise cette méthode pour résoudre {reservation} dans les routes.
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function creneau(): BelongsTo
    {
        return $this->belongsTo(Creneau::class);
    }

    public function codePromo(): BelongsTo
    {
        return $this->belongsTo(CodePromo::class);
    }

    public function paiement(): HasOne
    {
        return $this->hasOne(Paiement::class);
    }

    public function facture(): HasOne
    {
        return $this->hasOne(Facture::class);
    }

    public function estPayee(): bool
    {
        return $this->paiement && $this->paiement->statut === 'reussi';
    }
}