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
        Schema::create('fish_type_water', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fish_id');
            $table->unsignedBigInteger('type_water_id');
            $table->timestamps();

            $table->foreign('fish_id')->references('id')->on('fishes')->onDelete('cascade');
            $table->foreign('type_water_id')->references('id')->on('type_water')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fish_type_water');
    }
};
