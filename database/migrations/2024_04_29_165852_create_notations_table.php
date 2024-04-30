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
        Schema::create('notations', function (Blueprint $table) {
            $table->id();
            $table->integer('valeur');
            $table->unsignedBigInteger('critere_id');
            $table->unsignedBigInteger('utilisateur_id');
            $table->unsignedBigInteger('universite_id');
            $table->foreign('critere_id')->references('id')->on('criteres');
            $table->foreign('utilisateur_id')->references('id')->on('users');
            $table->foreign('universite_id')->references('id')->on('universites');
            $table->boolean('statut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notations');
    }
};
