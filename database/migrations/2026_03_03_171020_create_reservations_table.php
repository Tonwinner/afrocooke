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
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('creneau_id')->constrained('creneaux')->onDelete('cascade');
        $table->foreignId('code_promo_id')->nullable()->constrained('code_promos')->onDelete('set null');
        $table->integer('nombre_personnes')->default(2);
        $table->decimal('montant_total', 10, 2);
        $table->enum('statut', ['en_attente', 'confirmee', 'annulee', 'terminee'])->default('en_attente');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
