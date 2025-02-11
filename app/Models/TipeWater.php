<?php

namespace App\Models;

use Database\Factories\TipeWaterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TipeWater extends Model
{
    /** @use HasFactory<TipeWaterFactory> */
    use HasFactory;

    protected $fillable = ['type'];

    // Relación N:N con fish
    public function fish(): BelongsToMany
    {
        return $this->belongsToMany(Fish::class, 'fishes_type_water');
    }
}
