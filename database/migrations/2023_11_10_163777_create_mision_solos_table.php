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
        Schema::create('mision_solos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superheroe_id')->unsigned();
            $table->foreign('superheroe_id')->references('id')->on('superheroes');
            $table->bigInteger('misiones_id')->unsigned();
            $table->foreign('misiones_id')->references('id')->on('misions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mision_solos');
    }
};