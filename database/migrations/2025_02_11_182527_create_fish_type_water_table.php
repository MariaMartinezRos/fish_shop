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
            $table->foreignId('fish_id')->constrained('fishes')->onDelete('cascade');
            $table->foreignId('type_water_id')->constrained('type_water')->onDelete('cascade');
            $table->enum('state', ['Allowed', 'Forbidden', 'Biological rest'])->default('Allowed');
            $table->string('temperature_range'); // Ej: "22-28°C"
            $table->string('ph_range'); // Ej: "6.5-7.5"
            $table->decimal('salinity', 5, 2)->nullable(); // Ej: "1.025"
            $table->decimal('oxygen_level', 5, 2)->nullable(); // Ej: "5.0 mg/L"
            $table->enum('migration_pattern', ['Non-migratory', 'Anadromous', 'Catadromous '])->default('Non-migratory');
            $table->year('recorded_since')->nullable(); // Ej: 1990
            $table->text('notes')->nullable();
            $table->timestamps();
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
