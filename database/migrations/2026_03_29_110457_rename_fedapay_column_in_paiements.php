<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Renommer fedapay_transaction_id → transaction_id
     * pour être neutre et compatible avec tout système de paiement.
     */
    public function up(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->renameColumn('fedapay_transaction_id', 'transaction_id');
        });
    }

    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->renameColumn('transaction_id', 'fedapay_transaction_id');
        });
    }
};