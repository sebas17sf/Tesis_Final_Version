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
            $table->unsignedBigInteger('EstudianteID')->nullable();;
            $table->unsignedBigInteger('ProyectoID')->nullable();;
             $table->unsignedBigInteger('ParticipanteID')->nullable();;
            $table->unsignedBigInteger('IdPeriodo')->nullable();;
            $table->unsignedBigInteger('id_nrc_vinculacion')->nullable();
             $table->date('FechaInicio')->nullable();;
             $table->date('FechaFinalizacion')->nullable();;
             $table->date('FechaAsignacion')->nullable();;
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
