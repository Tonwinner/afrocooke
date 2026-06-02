<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Supprime l'ancienne contrainte PostgreSQL
        DB::statement("
            ALTER TABLE paiements
            DROP CONSTRAINT IF EXISTS paiements_methode_check
        ");

        // Ajoute la nouvelle contrainte compatible Kkiapay
        DB::statement("
            ALTER TABLE paiements
            ADD CONSTRAINT paiements_methode_check
            CHECK (
                methode IN (
                    'kkiapay',
                    'especes'
                )
            )
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE paiements
            DROP CONSTRAINT IF EXISTS paiements_methode_check
        ");

        DB::statement("
            ALTER TABLE paiements
            ADD CONSTRAINT paiements_methode_check
            CHECK (
                methode IN (
                    'fedapay',
                    'especes'
                )
            )
        ");
    }
};