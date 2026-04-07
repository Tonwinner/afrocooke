<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Facture extends Model
{
    protected $fillable = [
        'reservation_id',
        'numero_facture',
        'montant_ht',
        'montant_ttc',
        'fichier_pdf',
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

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public static function genererNumero(): string
    {
        $annee = now()->format('Y');
        $dernier = self::whereYear('created_at', $annee)->count() + 1;
        return 'FAC-' . $annee . '-' . str_pad($dernier, 5, '0', STR_PAD_LEFT);
    }
}