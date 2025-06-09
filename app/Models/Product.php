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

    /**
     * Scope a query to analyze products with inventory and sales metrics.
     *
     * @param Builder $query
     * @param array|null $categoryIds Array of category IDs to filter by
     * @param float|null $stockThreshold Minimum stock level
     * @param float|null $minPrice Minimum price per kg
     * @param float|null $maxPrice Maximum price per kg
     * @param bool $includeSalesMetrics Whether to include sales performance metrics
     * @param int|null $daysOnSaleThreshold Minimum days on sale
     * @return Builder
     */
    public function scopeByInventoryMetrics(
        Builder $query,
        ?array $categoryIds = null,
        ?float $stockThreshold = null,
        ?float $minPrice = null,
        ?float $maxPrice = null,
        bool $includeSalesMetrics = false,
        ?int $daysOnSaleThreshold = null
    ): Builder {
        $query = $query->when($categoryIds !== null, function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            })
            ->when($stockThreshold !== null, function ($query) use ($stockThreshold) {
                $query->where('stock_kg', '>=', $stockThreshold);
            })
            ->when($minPrice !== null, function ($query) use ($minPrice) {
                $query->where('price_per_kg', '>=', $minPrice);
            })
            ->when($maxPrice !== null, function ($query) use ($maxPrice) {
                $query->where('price_per_kg', '<=', $maxPrice);
            })
            ->when($daysOnSaleThreshold !== null, function ($query) use ($daysOnSaleThreshold) {
                $query->whereHas('fishes', function ($query) use ($daysOnSaleThreshold) {
                    $query->where('fish_product.days_on_sale', '>=', $daysOnSaleThreshold);
                });
            });

        if ($includeSalesMetrics) {
            $query->withCount(['fishes as total_fish_types' => function ($query) {
                $query->select(\DB::raw('COUNT(DISTINCT fish_id)'));
            }])
            ->withSum('fishes as total_days_on_sale', 'fish_product.days_on_sale')
            ->withAvg('fishes as average_days_on_sale', 'fish_product.days_on_sale');
        }

        return $query;
    }
}
