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
        Schema::create('asignacion_sin_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyectoId')->nullable();;
            $table->unsignedBigInteger('participanteId')->nullable();;
            $table->unsignedBigInteger('idPeriodo')->nullable();;
            $table->date('inicioFecha')->nullable();;
            $table->date('finalizacionFecha')->nullable();;

            $table->foreign('proyectoId')->references('proyectoId')->on('proyectos');
            $table->foreign('participanteId')->references('id')->on('profesuniversidad');
            $table->foreign('idPeriodo')->references('id')->on('periodo');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacion_sin_estudiantes');
    }
};
