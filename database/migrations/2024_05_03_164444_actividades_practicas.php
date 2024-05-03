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
            $table->string('Actividad');
            $table->integer('horas');
            $table->unsignedBigInteger('EstudianteID');
            $table->foreign('EstudianteID')->references('EstudianteID')->on('estudiantes');
            $table->unsignedBigInteger('IDPracticasI');
            $table->foreign('IDPracticasI')->references('PracticasI')->on('practicasi');
            $table->string('observaciones');
            $table->date('fechaActividad');
            $table->string('departamento');
            $table->string('funcion');
            $table->longText('evidencia');
            $table->timestamps();
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('actividades_practicas');
    }
};
