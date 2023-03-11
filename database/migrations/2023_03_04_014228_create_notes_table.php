<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
    Schema::create('notes', function (Blueprint $table) {
        $table->id();
        $table->integer('etudiant_id')->unsigned();
        $table->integer('module_id')->unsigned();
        $table->float('note_tp');
        $table->float('note_cf');
        $table->float('note_generale');
        $table->string('etat');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
