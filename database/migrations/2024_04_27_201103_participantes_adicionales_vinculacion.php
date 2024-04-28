<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('participantesAdicionales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ProyectoID');
            $table->foreign('ProyectoID')->references('ProyectoID')->on('proyectos')->onDelete('cascade');
             $table->unsignedBigInteger('ParticipanteID');  
            $table->foreign('ParticipanteID')->references('id')->on('profesUniversidad')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantesAdicionales');
    }
};
