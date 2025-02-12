<?php

namespace App\Models;

use Database\Factories\TypeWaterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TypeWater extends Model
{
    /** @use HasFactory<TypeWaterFactory> */
    use HasFactory;

    protected $fillable = ['type'];

    // Relación N:N con fish
    public function fishes(): BelongsToMany
    {
        return $this->belongsToMany(Fish::class, 'fish_type_water');
    }
}
