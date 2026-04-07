<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ajouter une colonne uuid aux tables exposées au public.
     * Les UUIDs sont utilisés dans les URLs pour empêcher
     * la devinabilité des IDs numériques.
     */
    public function up(): void
    {
        // Ajouter la colonne uuid à chaque table
        $tables = ['reservations', 'creneaux', 'factures'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->uuid('uuid')->nullable()->unique()->after('id');
            });

            // Générer un UUID pour les lignes existantes
            $rows = DB::table($table)->whereNull('uuid')->get();
            foreach ($rows as $row) {
                DB::table($table)->where('id', $row->id)->update([
                    'uuid' => Str::uuid()->toString(),
                ]);
            }
        }
    }

    public function down(): void
    {
        $tables = ['reservations', 'creneaux', 'factures'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->dropColumn('uuid');
            });
        }
    }
};