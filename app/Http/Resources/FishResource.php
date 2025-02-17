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
            'photo' => $this->photo,
            'type' => $this->type,
            'description' => $this->when($request->is('api/fishes*'), function () use ($request) {
                if ($request->is('api/fishes')) {
                    return str($this->description)->limit(20);
                }

                return $this->description;
            }),
        ];
    }
}
