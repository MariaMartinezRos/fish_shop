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
            'image' => $this->image,
            'type' => $this->typeWater->pluck('type'),
            'description' => $this->description,
            'state' => $this->typeWater->pluck('pivot.state')->first(),
            'temperature_range' => $this->typeWater->pluck('pivot.temperature_range')->first(),
            'ph_range' => $this->typeWater->pluck('pivot.ph_range')->first(),
            'salinity' => $this->typeWater->pluck('pivot.salinity')->first(),
            'oxygen_level' => $this->typeWater->pluck('pivot.oxygen_level')->first(),
            'notes' => $this->typeWater->pluck('pivot.notes')->first(),
        ];
    }
}

//$table->enum('state', ['allowed', 'forbidden'])->default('allowed');
//$table->string('temperature_range'); // Ej: "22-28°C"
//$table->string('ph_range'); // Ej: "6.5-7.5"
//$table->decimal('salinity', 5, 2)->nullable(); // Ej: "1.025"
//$table->decimal('oxygen_level', 5, 2)->nullable(); // Ej: "5.0 mg/L"
//$table->text('notes')->nullable();
