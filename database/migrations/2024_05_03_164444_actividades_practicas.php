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
        Schema::create('actividades_practicas', function (Blueprint $table) {
            $table->id();
            $table->string('actividad');
            $table->integer('horas');
            $table->unsignedBigInteger('estudianteId');
            $table->foreign('estudianteId')->references('estudianteId')->on('estudiantes');
            $table->unsignedBigInteger('idPracticasi');
            $table->foreign('idPracticasi')->references('practicasI')->on('practicasi');
            $table->string('observaciones');
            $table->date('fechaActividad');
            $table->string('departamento');
            $table->string('funcion');
            $table->longText('evidencia')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('actividades_practicas');
    }
};
