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
        Schema::create('fishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scientific_name')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->decimal('average_size_cm', 5, 2)->nullable();
            $table->enum('diet', ['Carnivore', 'Herbivore', 'Omnivore'])->default('Omnivore');
            $table->integer('lifespan_years')->nullable();
            $table->string('habitat')->nullable();
            $table->string('conservation_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fishes');
    }
};
