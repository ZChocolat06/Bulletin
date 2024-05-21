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
        Schema::table('eleves', function (Blueprint $table) {
            $table->unsignedBigInteger('bulletin_id');

            // Assuming the primary key of 'matieres' table is 'id'
            $table->foreign('bulletin_id')->references('id')->on('bulletins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eleves', function (Blueprint $table) {
            $table->dropForeign(['bulletin_id']);
            $table->dropColumn('bulletin_id');
        });
    }
};
