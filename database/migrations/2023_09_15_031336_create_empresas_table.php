<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombreEmpresa')->nullable();
            $table->string('rucEmpresa')->nullable();
            $table->string('provincia')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('correo')->nullable();
            $table->string('nombreContacto')->nullable();
            $table->string('telefonoContacto')->nullable();
            $table->string('actividadesMacro')->nullable();
            $table->integer('cuposDisponibles')->nullable();
            $table->binary('cartaCompromiso')->length(1000000)->nullable();
            $table->binary('convenio')->length(1000000)->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
