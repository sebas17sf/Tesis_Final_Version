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
        Schema::create('practicasiv', function (Blueprint $table) {
            $table->id('PracticasIV');
             $table->unsignedBigInteger('EstudianteID')->nullable();
             $table->unsignedBigInteger('nrc')->nullable();
            $table->foreign('nrc')->references('id')->on('nrc_vinculacion')->nullable();
            $table->foreign('EstudianteID')->references('EstudianteID')->on('estudiantes')->nullable();
            $table->unsignedBigInteger('IDEmpresa')->nullable();
            $table->foreign('IDEmpresa')->references('id')->on('empresas')->nullable();
            $table->unsignedBigInteger('ID_tutorAcademico')->nullable();
            $table->foreign('ID_tutorAcademico')->references('id')->on('profesUniversidad')->nullable();
            $table->string('tipoPractica')->nullable();
            $table->string('CedulaTutorEmpresarial')->nullable();
            $table->string('NombreTutorEmpresarial')->nullable();
            $table->string('Funcion')->nullable();
            $table->string('TelefonoTutorEmpresarial')->nullable();
            $table->string('EmailTutorEmpresarial')->nullable();
            $table->string('DepartamentoTutorEmpresarial')->nullable();
            $table->string('EstadoAcademico')->nullable();
            $table->date('FechaInicio')->nullable();
            $table->date('FechaFinalizacion')->nullable();
            $table->string('HorasPlanificadas')->nullable();
            $table->string('HoraEntrada')->nullable();
            $table->string('HoraSalida')->nullable();
            $table->string('AreaConocimiento')->nullable();
            $table->string('Estado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practicasiv');
    }
};
