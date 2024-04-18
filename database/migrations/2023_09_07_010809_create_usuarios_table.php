<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('Usuarios', function (Blueprint $table) {
            $table->id('UserID');
            $table->string('NombreUsuario');
            $table->string('CorreoElectronico')->unique();
            $table->string('Contrasena');
            $table->string('FechaNacimiento');
            $table->string('TipoUsuario');
            $table->string('Estado');
            $table->string('token')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Usuarios');
    }
};