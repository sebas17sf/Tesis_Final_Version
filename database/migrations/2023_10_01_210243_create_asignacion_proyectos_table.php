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
        Schema::create('AsignacionProyectos', function (Blueprint $table) {
            $table->id('AsignacionID');
            $table->unsignedBigInteger('EstudianteID');
            $table->unsignedBigInteger('ProyectoID');
            $table->unsignedBigInteger('DirectorID');
            $table->unsignedBigInteger('ParticipanteID');
            $table->date('FechaAsignacion');
            $table->timestamps();

            $table->foreign('EstudianteID')->references('EstudianteID')->on('Estudiantes');
            $table->foreign('ProyectoID')->references('ProyectoID')->on('Proyectos');
            $table->foreign('DirectorID')->references('id')->on('ProfesUniversidad');
            $table->foreign('ParticipanteID')->references('id')->on('ProfesUniversidad');
        });
    }

    public function down()
    {
        Schema::dropIfExists('AsignacionProyectos');
    }
};
