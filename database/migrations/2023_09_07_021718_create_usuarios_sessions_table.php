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
        Schema::create('usuarios_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserID');
            $table->string('session_id');
            $table->dateTime('start_time');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('locality')->nullable();
            $table->timestamps();
            $table->foreign('UserID')->references('UserID')->on('usuarios')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_sessions');
    }
};
