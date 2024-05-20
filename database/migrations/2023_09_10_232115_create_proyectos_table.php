<?php

 use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;




return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id('ProyectoID');
            $table->text('NombreProyecto');
            $table->string('codigoProyecto')->nullable();
            $table->text('DescripcionProyecto');
            $table->string('DepartamentoTutor');
             $table->string('Estado');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('proyectos');
    }


};

