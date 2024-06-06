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
        Schema::create('notasEstudiante', function (Blueprint $table) {
            $table->id('ID_Notas');
            $table->unsignedBigInteger('EstudianteID')->nullable();
            $table->foreign('EstudianteID')->references('EstudianteID')->on('estudiantes');
            $table->decimal('Tareas', 5, 2)->nullable();
            $table->decimal('Resultados_Alcanzados', 5, 2)->nullable();
            $table->decimal('Conocimientos', 5, 2)->nullable();
            $table->decimal('Adaptabilidad', 5, 2)->nullable();
            $table->decimal('Aplicacion', 5, 2)->nullable();
            $table->decimal('Capacidad_liderazgo', 5, 2)->nullable();
            $table->decimal('Asistencia', 5, 2)->nullable();
            $table->string('Informe');
            $table->decimal('Nota_Final', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notasEstudiante');
    }
};
