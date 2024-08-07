<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformeparticipanteVinculacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informeparticipante_vinculacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('participanteId');
            $table->text('objetivos')->nullable();
            $table->string('intervencion')->nullable();
            $table->json('actividadesPlanificadas')->nullable();
            $table->json('resultadosAlcanzados')->nullable();
            $table->json('porcentajesAlcanzados')->nullable();
            $table->integer('hombres')->nullable();
            $table->integer('mujeres')->nullable();
            $table->integer('niños')->nullable();
            $table->integer('personasConDiscapacidad')->nullable();
            $table->text('observacionesHombres')->nullable();
            $table->text('observacionesMujeres')->nullable();
            $table->text('observacionesNiños')->nullable();
            $table->text('observacionesPersonasConCapacidad')->nullable();
            $table->text('conclusiones')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->timestamps();

            $table->foreign('participanteId')->references('id')->on('profesuniversidad')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informeparticipante_vinculacion');
    }
}
