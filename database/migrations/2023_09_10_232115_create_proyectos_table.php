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
            $table->unsignedBigInteger('id_directorProyecto');  
            $table->unsignedBigInteger('id_docenteParticipante');
            $table->unsignedBigInteger('id_nrc_vinculacion'); 
            $table->foreign('id_directorProyecto')->references('id')->on('profesUniversidad');
            $table->foreign('id_docenteParticipante')->references('id')->on('profesUniversidad');
            $table->foreign('id_nrc_vinculacion')->references('id')->on('nrc_vinculacion');  
            $table->text('NombreProyecto');
            $table->string('codigoProyecto')->nullable();
            $table->text('DescripcionProyecto');
            $table->string('DepartamentoTutor');
            $table->date('FechaInicio');
            $table->date('FechaFinalizacion');
            $table->integer('cupos');
            $table->string('Estado');
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }

    
};

