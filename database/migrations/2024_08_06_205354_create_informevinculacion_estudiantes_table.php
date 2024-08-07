<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('informevinculacion_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudianteId');
            $table->string('nombre_comunidad')->nullable();
            $table->json('provincias')->nullable();
            $table->json('cantones')->nullable();
            $table->json('parroquias')->nullable();
            $table->json('direcciones')->nullable();
            $table->json('especificos')->nullable();
            $table->json('alcanzados')->nullable();
            $table->json('porcentajes')->nullable();
            $table->text('conclusiones1')->nullable();
            $table->text('conclusiones2')->nullable();
            $table->text('conclusiones3')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->timestamps();

            $table->foreign('estudianteId')->references('estudianteId')->on('estudiantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informevinculacion_estudiantes');
    }
};
