<?php

namespace App\Models;

use Database\Factories\FishFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static exists()
 * @method static create(array $data)
 * @method static where(string $string, string $string1)
 */
class Fish extends Model
{
    /** @use HasFactory<FishFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'fishes';

    protected $fillable = [
        'name',
        'scientific_name',
        'image',
        'description',
        'average_size_cm',
        'diet',
        'lifespan_years',
        'habitat',
        'conservation_status',
    ];

    protected $casts = [
        'average_size_cm' => 'decimal:2',
        'lifespan_years' => 'integer',
    ];

    // Relación N:N con tipos_agua
    public function TypeWater(): BelongsToMany
    {
        return $this->belongsToMany(TypeWater::class, 'fish_type_water')
            ->withPivot([
                'state',
                'temperature_range',
                'ph_range',
                'salinity',
                'oxygen_level',
                'migration_pattern',
                'recorded_since',
                'notes',
            ]);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['days_on_sale', 'supplier']);
    }
}
