<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('profesuniversidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId')->nullable();
            $table->foreign('userId')->references('userId')->on('usuarios')->nullable();
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('correo');
            $table->string('usuario');
            $table->string('cedula');
            $table->string('espeId')->nullable();
            $table->string('departamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesuniversidad');
    }
};
