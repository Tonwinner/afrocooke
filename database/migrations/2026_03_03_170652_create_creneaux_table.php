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
    Schema::create('creneaux', function (Blueprint $table) {
        $table->id();
        $table->foreignId('atelier_id')->constrained('ateliers')->onDelete('cascade');
        $table->foreignId('chef_id')->nullable()->constrained('users')->onDelete('set null');
        $table->date('date');
        $table->time('heure_debut');
        $table->time('heure_fin');
        $table->integer('places_restantes');
        $table->enum('statut', ['disponible', 'complet', 'annule'])->default('disponible');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creneaux');
    }
};
