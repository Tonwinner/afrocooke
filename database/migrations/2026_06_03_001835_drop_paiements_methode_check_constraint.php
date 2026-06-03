<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();
        
        if ($driver === 'pgsql') {
            // PostgreSQL : suppression de la contrainte
            DB::statement('ALTER TABLE paiements DROP CONSTRAINT IF EXISTS paiements_methode_check');
        } elseif ($driver === 'mysql') {
            // MySQL : suppression de la contrainte
            DB::statement('ALTER TABLE paiements DROP CHECK IF EXISTS paiements_methode_check');
        }
    }

    public function down(): void
    {
        // Recréation de la contrainte si nécessaire
        $driver = DB::connection()->getDriverName();
        
        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE paiements ADD CONSTRAINT paiements_methode_check CHECK (methode IN (\'fedapay\', \'kkiapay\'))');
        } elseif ($driver === 'mysql') {
            DB::statement('ALTER TABLE paiements ADD CONSTRAINT paiements_methode_check CHECK (methode IN ("fedapay", "kkiapay"))');
        }
    }
};