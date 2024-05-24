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
        Schema::create('asignacionProyectos', function (Blueprint $table) {
            $table->id('AsignacionID');
            $table->unsignedBigInteger('EstudianteID');
            $table->unsignedBigInteger('ProyectoID');
             $table->unsignedBigInteger('ParticipanteID');
            $table->unsignedBigInteger('IdPeriodo');
            $table->unsignedBigInteger('id_nrc_vinculacion');
             $table->date('FechaInicio');
             $table->date('FechaFinalizacion');
             $table->date('FechaAsignacion');
            $table->timestamps();
            $table->foreign('EstudianteID')->references('EstudianteID')->on('estudiantes');
            $table->foreign('ProyectoID')->references('ProyectoID')->on('proyectos');
            $table->foreign('id_nrc_vinculacion')->references('id')->on('nrc_vinculacion');
             $table->foreign('ParticipanteID')->references('id')->on('profesUniversidad');
            $table->foreign('IdPeriodo')->references('id')->on('periodo');
         });
    }

    public function down()
    {
        Schema::dropIfExists('asignacionProyectos');
    }
};
