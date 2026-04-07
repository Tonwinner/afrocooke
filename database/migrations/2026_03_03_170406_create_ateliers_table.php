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
    Schema::create('ateliers', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('slug')->unique();
        $table->text('description');
        $table->string('plat');
        $table->string('origine_pays');
        $table->decimal('prix', 10, 2);
        $table->integer('duree_minutes');
        $table->integer('max_participants')->default(6);
        $table->string('photo')->nullable();
        $table->enum('statut', ['actif', 'inactif', 'complet'])->default('actif');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ateliers');
    }
};
