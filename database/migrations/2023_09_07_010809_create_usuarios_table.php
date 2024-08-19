<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('userId');
            $table->string('nombreUsuario')->nullable();
            $table->string('correoElectronico')->unique()->nullable();
            $table->string('contrasena')->nullable();
            $table->string('estado')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('token_expires_at')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('role_id_administrativo')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            $table->foreign('role_id_administrativo')->references('id')->on('roles')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
