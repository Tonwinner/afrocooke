<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
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