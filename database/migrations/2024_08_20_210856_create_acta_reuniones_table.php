<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActaReunionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acta_reuniones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participanteId'); // Llave foránea a la tabla de participantes
            $table->unsignedBigInteger('proyectoId'); // Llave foránea a la tabla de proyectos
            $table->string('lugar');
            $table->string('tema');
            $table->date('fecha');
            $table->time('horaInicial');
            $table->time('horaFinal');
            $table->text('objetivo');
            $table->text('antecedentes');
            $table->json('acciones');
            $table->json('responsables');
            $table->json('fechaAcciones');
            $table->timestamps();

            // Relación con la tabla de participantes
            $table->foreign('participanteId')->references('id')->on('profesuniversidad')->onDelete('cascade');
            // Relación con la tabla de proyectos
            $table->foreign('proyectoId')->references('id')->on('proyectos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acta_reuniones');
    }
}
