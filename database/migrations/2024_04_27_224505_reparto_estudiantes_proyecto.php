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
        Schema::create('asignacionEstudiantesDirector', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('DirectorID');
            $table->unsignedBigInteger('IDProyecto');
            $table->unsignedBigInteger('ParticipanteID');
            $table->unsignedBigInteger('EstudianteID');
             $table->timestamps();

            $table->foreign('IDProyecto')->references('ProyectoID')->on('proyectos')->onDelete('cascade');
            $table->foreign('DirectorID')->references('id')->on('profesUniversidad')->onDelete('cascade');
            $table->foreign('ParticipanteID')->references('id')->on('profesUniversidad')->onDelete('cascade');
            $table->foreign('EstudianteID')->references('EstudianteID')->on('estudiantes')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacionEstudiantesDirector');
    }
};
