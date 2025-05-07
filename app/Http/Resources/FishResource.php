<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'scientific_name' => $this->scientific_name,
            'image' => $this->image,
            'description' => $this->description,
            'average_size_cm' => $this->average_size_cm,
            'diet' => $this->diet,
            'lifespan_years' => $this->lifespan_years,
            'habitat' => $this->habitat,
            'conservation_status' => $this->conservation_status,
            'type' => $this->typeWater->pluck('type'),
            'characteristics' => [
                'state' => $this->typeWater->pluck('pivot.state')->first(),
                'temperature_range' => $this->typeWater->pluck('pivot.temperature_range')->first(),
                'ph_range' => $this->typeWater->pluck('pivot.ph_range')->first(),
                'salinity' => $this->typeWater->pluck('pivot.salinity')->first(),
                'oxygen_level' => $this->typeWater->pluck('pivot.oxygen_level')->first(),
                'migration_pattern' => $this->typeWater->pluck('pivot.migration_pattern')->first(),
                'recorded_since' => $this->typeWater->pluck('pivot.recorded_since')->first(),
                'notes' => $this->typeWater->pluck('pivot.notes')->first(),
            ],
            'water_type_details' => $this->typeWater->map(function ($typeWater) {
                return [
                    'type' => $typeWater->type,
                    'ph_level' => $typeWater->ph_level,
                    'temperature_range' => $typeWater->temperature_range,
                    'salinity_level' => $typeWater->salinity_level,
                    'region' => $typeWater->region,
                    'description' => $typeWater->description,
                ];
            })->first(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

//$table->enum('state', ['allowed', 'forbidden'])->default('allowed');
//$table->string('temperature_range'); // Ej: "22-28°C"
//$table->string('ph_range'); // Ej: "6.5-7.5"
//$table->decimal('salinity', 5, 2)->nullable(); // Ej: "1.025"
//$table->decimal('oxygen_level', 5, 2)->nullable(); // Ej: "5.0 mg/L"
//$table->text('notes')->nullable();
