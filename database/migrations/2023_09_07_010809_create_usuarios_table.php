<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('UserID');
            $table->string('NombreUsuario');
            $table->string('CorreoElectronico')->unique();
            $table->string('Contrasena');
             $table->string('Estado');
            $table->string('token')->nullable();
            $table->timestamp('token_expires_at')->nullable();
            $table->string('google_id')->nullable();
            $table->string('github_id')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
