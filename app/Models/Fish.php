<?php

namespace App\Models;

use Database\Factories\FishFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static exists()
 * @method static create(array $data)
 * @method static where(string $string, string $string1)
 */
class Fish extends Model
{
    /** @use HasFactory<FishFactory> */
    use HasFactory;

    protected $table = 'fishes';

    protected $fillable = ['name', 'image', 'description'];

    // Relación N:N con tipos_agua
    public function TypeWater(): BelongsToMany
    {
        return $this->belongsToMany(TypeWater::class, 'fish_type_water')
            ->withPivot('state');
    }
}
