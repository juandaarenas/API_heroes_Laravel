<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('misions', function (Blueprint $table) {
            $table->id();
            $table->String('mision');
            $table->bigInteger('tipo_mision_id')->unsigned();
            $table->foreign('tipo_mision_id')->references('id')->on('tipo_misions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('misions');
    }
};