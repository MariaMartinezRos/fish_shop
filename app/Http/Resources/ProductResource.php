<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id' => $this->category_id,
            'price_per_kg' => $this->price_per_kg,
            'stock_kg' => $this->stock_kg,
            'description' => $this->description,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'fishes' => $this->whenLoaded('fishes', function() {
                return $this->fishes->map(function($fish) {
                    return [
                        'id' => $fish->id,
                        'name' => $fish->name,
                        'days_on_sale' => $fish->pivot->days_on_sale,
                        'supplier' => $fish->pivot->supplier,
                    ];
                });
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 