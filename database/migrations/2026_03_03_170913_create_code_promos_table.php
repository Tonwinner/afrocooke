<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void 
   {
    Schema::create('code_promos', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->enum('type_reduction', ['pourcentage', 'montant_fixe']);
        $table->decimal('valeur', 10, 2);
        $table->date('date_debut');
        $table->date('date_fin');
        $table->integer('usage_max')->default(100);
        $table->integer('usage_actuel')->default(0);
        $table->enum('statut', ['actif', 'inactif', 'expire'])->default('actif');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_promos');
    }
};
