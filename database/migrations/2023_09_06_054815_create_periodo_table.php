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
        Schema::create('periodo', function (Blueprint $table) {
            $table->id();
            $table->string('periodo', 200);
            $table->integer('numeroPeriodo');
            $table->date('inicioPeriodo');
            $table->date('finPeriodo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodo');
    }
};
