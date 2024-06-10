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
            $table->text('nombreProyecto');
            $table->string('codigoProyecto')->nullable();
            $table->text('descripcionProyecto');
            $table->string('departamentoTutor');
            $table->Date('inicioFecha')->nullable();;
            $table->Date('finFecha')->nullable();;
             $table->string('estado');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('proyectos');
    }


};

