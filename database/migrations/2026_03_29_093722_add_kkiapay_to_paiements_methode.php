<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Modifier la colonne methode pour accepter 'kkiapay'
     * en plus de 'fedapay'.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE paiements MODIFY methode ENUM('fedapay', 'kkiapay', 'carte', 'mobile_money') DEFAULT 'kkiapay'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE paiements MODIFY methode ENUM('fedapay') DEFAULT 'fedapay'");
    }
};