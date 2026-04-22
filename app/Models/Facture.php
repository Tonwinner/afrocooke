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

    /**
     * Génère un numéro de facture unique.
     */
    public static function genererNumero(): string
    {
        $annee = now()->format('Y');
        $prefix = 'FAC-' . $annee . '-';
        
        // Chercher le dernier numéro utilisé (et NON PAS compter)
        $dernier = self::where('numero_facture', 'LIKE', $prefix . '%')
                       ->orderBy('numero_facture', 'DESC')
                       ->first();
        
        if ($dernier) {
            // Extraire le chiffre des 5 derniers caractères
            $dernierNumero = (int) substr($dernier->numero_facture, -5);
            $nouveauNumero = $dernierNumero + 1;
        } else {
            $nouveauNumero = 1;
        }
        
        return $prefix . str_pad($nouveauNumero, 5, '0', STR_PAD_LEFT);
    }

}