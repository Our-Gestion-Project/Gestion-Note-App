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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('etudiant_id');
            $table->bigInteger('module_id');
            $table->bigInteger('session_id');
            $table->decimal('CF_N',9,2);
            $table->decimal('TP_N',9,2);
            $table->decimal('MG_N',9,2);
            $table->decimal('CF_R',9,2);
            $table->decimal('MG_R',9,2);
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
