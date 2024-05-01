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
        Schema::create('practicasi', function (Blueprint $table) {
            $table->id('PracticasI');
            $table->unsignedBigInteger('EstudianteID');
            $table->unsignedBigInteger('id_nrc_practicas1');
            $table->foreign('id_nrc_practicas1')->references('id')->on('nrc_practicas1');
            $table->foreign('EstudianteID')->references('EstudianteID')->on('estudiantes');
            $table->unsignedBigInteger('IDEmpresa');
            $table->foreign('IDEmpresa')->references('id')->on('empresas');
            $table->unsignedBigInteger('ID_tutorAcademico');
            $table->foreign('ID_tutorAcademico')->references('id')->on('profesUniversidad');
            $table->string('tipoPractica');
            $table->string('CedulaTutorEmpresarial');
            $table->string('NombreTutorEmpresarial');
            $table->string('Funcion');
            $table->string('TelefonoTutorEmpresarial');
            $table->string('EmailTutorEmpresarial');
            $table->string('DepartamentoTutorEmpresarial');
            $table->string('EstadoAcademico');
            $table->date('FechaInicio');
            $table->date('FechaFinalizacion');
            $table->string('HorasPlanificadas');
            $table->string('HoraEntrada');
            $table->string('HoraSalida');
            $table->string('AreaConocimiento');
            $table->string('Estado');
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('practicasi');
    }
};
