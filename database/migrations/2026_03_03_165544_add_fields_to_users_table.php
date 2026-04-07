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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['admin', 'chef', 'logistique', 'client'])->default('client')->after('email');
        $table->string('telephone', 20)->nullable()->after('role');
        $table->string('adresse')->nullable()->after('telephone');
        $table->string('photo')->nullable()->after('adresse');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'telephone', 'adresse', 'photo']);
    });
    }
};
