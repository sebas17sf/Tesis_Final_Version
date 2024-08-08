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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id('proyectoId');
            $table->unsignedBigInteger('directorId')->nullable();
            $table->foreign('directorId')->references('id')->on('profesuniversidad');
            $table->text('nombreProyecto')->nullable();
            $table->string('codigoProyecto')->nullable();
            $table->text('descripcionProyecto')->nullable();
            $table->string('departamentoTutor')->nullable();
            $table->date('inicioFecha')->nullable();
            $table->date('finFecha')->nullable();
            $table->string('estado')->nullable();
            $table->string('comunidad')->nullable();
            $table->string('provincia')->nullable();
            $table->string('canton')->nullable();
            $table->string('parroquia')->nullable();
            $table->string('direccion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
};
