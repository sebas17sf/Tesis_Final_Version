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
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')->references('UserID')->on('usuarios');
            $table->string('Nombres', 20);
            $table->string('Apellidos', 20);
            $table->string('espe_id', 20);
            $table->string('celular');
            $table->String('cedula');
            $table->unsignedBigInteger('id_cohorte');
            $table->unsignedBigInteger('id_periodo');
            $table->String('Carrera');
            $table->String('Correo');
            $table->String('Provincia');
            $table->String('Departamento');
            $table->string ('Estado');
            $table->string('comentario');

            // Definir las relaciones con las tablas Cohorte y Periodo
            $table->foreign('id_cohorte')->references('ID_cohorte')->on('cohorte');
            $table->foreign('id_periodo')->references('id')->on('periodo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
