<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id('EstudianteID');
            $table->unsignedBigInteger('UserID')->nullable();
            $table->foreign('UserID')->references('UserID')->on('usuarios')->nullable();
            $table->string('Nombres');
            $table->string('Apellidos');
            $table->string('espe_id')->nullable();
            $table->string('celular')->nullable();
            $table->string('cedula')->nullable();
            $table->unsignedBigInteger('id_periodo')->nullable();
            $table->string('Cohorte')->nullable();
            $table->string('Carrera')->nullable();
            $table->string('Correo')->nullable();
            $table->string('Provincia')->nullable();
            $table->string('Departamento')->nullable();
            $table->string('Estado')->nullable();
            $table->string('comentario')->nullable();
        
            // Definir las relaciones con las tablas Cohorte y Periodo
            $table->foreign('id_periodo')->references('id')->on('periodo')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
