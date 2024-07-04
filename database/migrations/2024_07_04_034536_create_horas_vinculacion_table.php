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
        Schema::create('horas_vinculacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudianteId')->nullable();
            $table->integer('horasVinculacion')->nullable();
            $table->foreign('estudianteId')->references('estudianteId')->on('estudiantes');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horas_vinculacion');
    }
};
