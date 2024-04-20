<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nrc_vinculacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_periodo');
            $table->string('nrc');
            $table->timestamps();

             $table->foreign('id_periodo')->references('id')->on('periodo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nrc_vinculacion');
    }
};
