<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajouter les nouvelles méthodes de paiement
     */
    public function up(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->string('methode')
                ->default('kkiapay')
                ->change();
        });
    }

    /**
     * Retour arrière
     */
    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->string('methode')
                ->default('fedapay')
                ->change();
        });
    }
};