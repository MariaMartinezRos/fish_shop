<?php

namespace App\Models;

use Database\Factories\FishFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fish extends Model
{
    /** @use HasFactory<FishFactory> */
    use HasFactory;

    protected $fillable = ['name', 'image', 'description'];

    // Relación N:N con tipos_agua
    public function type_water(): BelongsToMany
    {
        return $this->belongsToMany(TipeWater::class, 'fishes_type_water');
    }
}
