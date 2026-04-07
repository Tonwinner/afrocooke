<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'telephone',
        'adresse',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class);
    }

    public function creneaux(): HasMany
    {
        return $this->hasMany(Creneau::class, 'chef_id');
    }

    public function estAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function estChef(): bool
    {
        return $this->role === 'chef';
    }

    public function estLogistique(): bool
    {
        return $this->role === 'logistique';
    }

    public function estClient(): bool
    {
        return $this->role === 'client';
    }
} 