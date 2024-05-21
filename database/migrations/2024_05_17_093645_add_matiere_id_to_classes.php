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
        Schema::table('classes', function (Blueprint $table) {
            $table->foreignId('matiere_id')->constrained('matieres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère avant de supprimer la colonne
            $table->dropForeign(['matiere_id']);
            $table->dropColumn('matiere_id');
        });
    }
};
