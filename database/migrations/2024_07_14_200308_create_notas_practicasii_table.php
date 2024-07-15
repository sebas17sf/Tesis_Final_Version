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
        Schema::create('notas_practicasii', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudianteId')->nullable();
            $table->double('notaTutor')->nullable();
            $table->double('notaAcademico')->nullable();
            $table->foreign('estudianteId')->references('estudianteId')->on('estudiantes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_practicasii');
    }
};
