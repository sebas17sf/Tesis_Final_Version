<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('profesUniversidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserID')->nullable();
            $table->foreign('UserID')->references('UserID')->on('usuarios')->nullable();
            $table->string('Apellidos');
            $table->string('Nombres');
            $table->string('Correo');
            $table->string('Usuario');
            $table->string('Cedula');
            $table->string('espe_id')->nullable();
            $table->string('Departamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profes_universidad');
    }
};
