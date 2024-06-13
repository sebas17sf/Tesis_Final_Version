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
        Schema::create('notas_estudiante', function (Blueprint $table) {
            $table->id('idNotas');
            $table->unsignedBigInteger('estudianteId')->nullable();
            $table->foreign('estudianteId')->references('estudianteId')->on('estudiantes');
            $table->decimal('tareas', 5, 2)->nullable();
            $table->decimal('resultadosAlcanzados', 5, 2)->nullable();
            $table->decimal('conocimientos', 5, 2)->nullable();
            $table->decimal('adaptabilidad', 5, 2)->nullable();
            $table->decimal('aplicacion', 5, 2)->nullable();
            $table->decimal('CapacidadLiderazgo', 5, 2)->nullable();
            $table->decimal('asistencia', 5, 2)->nullable();
            $table->string('informe')->nullable();
            $table->decimal('notaFinal', 5, 2)->nullable();
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
