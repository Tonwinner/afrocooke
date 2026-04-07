<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Compte administrateur
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@atelieradeux.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'telephone' => '+229 97 00 00 00',
        ]);

        // Compte chef cuisinier de démo
        User::create([
            'name' => 'Chef Amina',
            'email' => 'chef@atelieradeux.com',
            'password' => Hash::make('password123'),
            'role' => 'chef',
            'telephone' => '+229 96 00 00 00',
        ]);

        // Compte logistique de démo
        User::create([
            'name' => 'Responsable Stock',
            'email' => 'logistique@atelieradeux.com',
            'password' => Hash::make('password123'),
            'role' => 'logistique',
            'telephone' => '+229 95 00 00 00',
        ]);

        // Compte client de démo
        User::create([
            'name' => 'Client Test',
            'email' => 'client@atelieradeux.com',
            'password' => Hash::make('password123'),
            'role' => 'client',
            'telephone' => '+229 94 00 00 00',
        ]);
    }
}