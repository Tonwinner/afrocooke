<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table messages_contact : stocke les messages envoyés
     * via le formulaire de la page Contact.
     * L'admin peut les consulter dans son dashboard.
     */
    public function up(): void
    {
        Schema::create('messages_contact', function (Blueprint $table) {
            $table->id();
            $table->string('nom');              // Nom complet de l'expéditeur
            $table->string('email');            // Email de l'expéditeur
            $table->text('message');            // Contenu du message
            $table->boolean('lu')->default(false); // Lu ou non par l'admin
            $table->timestamps();              // created_at + updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages_contact');
    }
};