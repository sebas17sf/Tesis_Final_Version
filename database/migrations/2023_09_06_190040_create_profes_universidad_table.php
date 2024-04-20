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
            $table->string('Apellidos', 250);
            $table->string('Nombres', 250);
            $table->string('Correo', 250);
            $table->string('Usuario');
            $table->string('Cedula');
            $table->string('Departamento', 250);
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
