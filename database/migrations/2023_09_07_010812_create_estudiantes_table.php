<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id('estudianteId');
            $table->unsignedBigInteger('userId')->nullable();
            $table->foreign('userId')->references('userId')->on('usuarios')->nullable();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('espeId')->nullable();
            $table->string('celular')->nullable();
            $table->string('cedula')->nullable();
            $table->unsignedBigInteger('idPeriodo')->nullable();
            $table->string('Cohorte')->nullable();
            $table->string('carrera')->nullable();
            $table->string('correo')->nullable();
            $table->unsignedBigInteger('departamentoId')->nullable();
            $table->foreign('departamentoId')->references('id')->on('departamentos');
            $table->string('estado')->nullable();
            $table->string('comentario')->nullable();
            $table->boolean('activacion')->default(0);
            $table->boolean('actualizacion')->default(0);


            $table->foreign('idPeriodo')->references('id')->on('periodo')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
