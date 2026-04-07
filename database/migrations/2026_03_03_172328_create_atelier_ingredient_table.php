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
    Schema::create('atelier_ingredient', function (Blueprint $table) {
        $table->foreignId('atelier_id')->constrained('ateliers')->onDelete('cascade');
        $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('cascade');
        $table->decimal('quantite_necessaire', 10, 2);
        $table->primary(['atelier_id', 'ingredient_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atelier_ingredient');
    }
};
