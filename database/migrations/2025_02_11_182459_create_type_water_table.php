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
        Schema::create('type_water', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('description')->nullable();
            $table->decimal('ph_level', 3, 2)->nullable();
            $table->string('temperature_range')->nullable();
            $table->decimal('salinity_level', 5, 2)->nullable();
            $table->string('region')->nullable();
            $table->timestamps();
        });

        DB::table('type_water')->insert([
            [
                'type' => 'Freshwater',
                'description' => 'Water with low salt concentration, found in rivers and lakes.',
                'ph_level' => 7.2,
                'temperature_range' => '10-25°C',
                'salinity_level' => 0.05,
                'region' => 'Rivers, Lakes, Ponds'
            ],
            [
                'type' => 'Saltwater',
                'description' => 'Water with high salt concentration, found in oceans and seas.',
                'ph_level' => 8.1,
                'temperature_range' => '2-30°C',
                'salinity_level' => 35.00,
                'region' => 'Oceans, Seas'
            ]
        ]);

//        DB::table('type_water')->insert([
//            ['type' => 'Freshwater'],
//            ['type' => 'Saltwater'],
//        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_water');
    }
};
