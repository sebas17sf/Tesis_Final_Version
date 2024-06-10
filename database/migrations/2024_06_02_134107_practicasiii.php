<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('practicasiii', function (Blueprint $table) {
            $table->id('practicasIII');
            $table->unsignedBigInteger('estudianteId')->nullable();
             $table->unsignedBigInteger('nrc')->nullable();
            $table->foreign('nrc')->references('id')->on('nrc')->nullable();
            $table->foreign('estudianteId')->references('estudianteId')->on('estudiantes')->nullable();
            $table->unsignedBigInteger('idEmpresa')->nullable();
            $table->foreign('idEmpresa')->references('id')->on('empresas')->nullable();
            $table->unsignedBigInteger('idTutorAcademico')->nullable();
            $table->foreign('idTutorAcademico')->references('id')->on('profesuniversidad')->nullable();
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


    public function down(): void
    {
        Schema::dropIfExists('practicasiii');
    }
};
