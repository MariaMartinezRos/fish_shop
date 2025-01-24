<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
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
        $newProduct = new self();
        $newProduct->name = $product['name'];
        $newProduct->category_id = $product['category_id'];
        $newProduct->price_per_kg = $product['price_per_kg'];
        $newProduct->stock_kg = $product['stock_kg'];
        $newProduct->description = $product['description'];
        $newProduct->save();
        return $newProduct;
    }
}
