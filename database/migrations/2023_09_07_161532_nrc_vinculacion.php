<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
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
 
    public function down(): void
    {
        Schema::dropIfExists('nrc_vinculacion');
    }
};
