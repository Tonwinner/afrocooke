<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageContact extends Model
{
    /**
     * Table associée : messages_contact
     * Laravel cherche par défaut "message_contacts" (au pluriel),
     * on précise le bon nom ici.
     */
    protected $table = 'messages_contact';

    /**
     * Champs remplissables en masse (mass assignment).
     * Protège contre l'injection de données non voulues.
     */
    protected $fillable = [
        'nom',
        'email',
        'message',
        'lu',
    ];

    /**
     * Casts : convertit automatiquement le champ "lu"
     * en boolean PHP (true/false) au lieu de 0/1.
     */
    protected $casts = [
        'lu' => 'boolean',
    ];

    /**
     * Scope : récupérer uniquement les messages non lus.
     * Usage : MessageContact::nonLus()->count()
     */
    public function scopeNonLus($query)
    {
        return $query->where('lu', false);
    }
}