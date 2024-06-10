<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('nrc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPeriodo');
            $table->string('nrc')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();

             $table->foreign('idPeriodo')->references('id')->on('periodo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nrc');
    }
};
