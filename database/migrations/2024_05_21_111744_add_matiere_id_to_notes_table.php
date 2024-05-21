<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatiereIdToNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->unsignedBigInteger('matiere_id');

            // Assuming the primary key of 'matieres' table is 'id'
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign(['matiere_id']);
            $table->dropColumn('matiere_id');
        });
    }
}
