<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'price_per_kg',
        'stock_kg',
        'description',
    ];

    /**
     * Crea un nuevo producto.
     */
    public static function create(array $product): Product
    {
        $newProduct = new self;
        $newProduct->name = $product['name'];
        $newProduct->category_id = $product['category_id'];
        $newProduct->price_per_kg = $product['price_per_kg'];
        $newProduct->stock_kg = $product['stock_kg'];
        $newProduct->description = $product['description'];
        $newProduct->save();

        return $newProduct;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function fishes(): BelongsToMany
    {
        return $this->belongsToMany(Fish::class)
            ->withPivot(['days_on_sale', 'supplier']);
    }

    public function scopeSearch(Builder $query, $search): Builder
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->orWhere('stock_kg', 'like', "%{$search}%");
    }
}
