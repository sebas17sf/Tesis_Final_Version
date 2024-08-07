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
        Schema::create('actividades_estudiante', function (Blueprint $table) {
            $table->id('idActividades');
            $table->unsignedBigInteger('estudianteId');
            $table->foreign('estudianteId')->references('estudianteId')->on('estudiantes');
            $table->date('fecha');
            $table->text('actividades');
            $table->integer('numeroHoras');
            $table->longText('evidencias')->nullable();
            $table->string('nombreActividad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actividades_estudiante', function (Blueprint $table) {

        });
    }
};
