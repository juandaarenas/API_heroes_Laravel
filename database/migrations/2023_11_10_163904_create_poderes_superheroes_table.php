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
        Schema::create('poderes_superheroes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superheroe_id')->unsigned();
            $table->foreign('superheroe_id')->references('id')->on('superheroes');
            $table->bigInteger('superpoderes_id')->unsigned();
            $table->foreign('superpoderes_id')->references('id')->on('superpoders');
            $table->float('niveles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poderes_superheroes');
    }
};