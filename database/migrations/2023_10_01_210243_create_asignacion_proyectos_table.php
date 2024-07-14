<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asignacionproyectos', function (Blueprint $table) {
            $table->id('asignacionID');
            $table->unsignedBigInteger('estudianteId')->nullable();
            $table->unsignedBigInteger('proyectoId')->nullable();
            $table->unsignedBigInteger('participanteId')->nullable();
            $table->unsignedBigInteger('idPeriodo')->nullable();
            $table->unsignedBigInteger('nrc')->nullable();
            $table->date('inicioFecha')->nullable();
            $table->date('finalizacionFecha')->nullable();
            $table->date('asignacionFecha')->nullable();
            $table->timestamps();
            $table->foreign('estudianteId')->references('estudianteId')->on('estudiantes');
            $table->foreign('proyectoId')->references('proyectoId')->on('proyectos');
            $table->foreign('nrc')->references('id')->on('nrc');
            $table->foreign('participanteId')->references('id')->on('profesuniversidad');
            $table->foreign('idPeriodo')->references('id')->on('periodo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('asignacionproyectos');
    }
};
