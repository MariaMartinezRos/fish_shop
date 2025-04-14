<?php

namespace App\Models;

use Database\Factories\TypeWaterFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, string $string1)
 * @method static create(string[] $type)
 * @method static inRandomOrder()
 */
class TypeWater extends Model
{
    /** @use HasFactory<TypeWaterFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'type_water';

    protected $fillable = ['type'];

    // Relación N:N con fish
    public function fishes(): BelongsToMany
    {
        return $this->belongsToMany(Fish::class, 'fish_type_water');
    }
}
