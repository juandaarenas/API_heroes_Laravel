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
        Schema::create('mision_superheroes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('equipo_id')->unsigned();
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->bigInteger('mision_id')->unsigned();
            $table->foreign('mision_id')->references('id')->on('misions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mision_superheroes');
    }
};
