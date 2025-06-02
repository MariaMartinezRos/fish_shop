<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Get a list of all products.
     *
     * @group Products V2
     *
     * @response 200 {
     *    "data": [
     *      {
     *        "id": 1,
     *        "name": "Fresh Salmon",
     *        "category_id": 1,
     *        "price_per_kg": 25.99,
     *        "stock_kg": 100.5,
     *        "description": "Fresh Atlantic Salmon",
     *        "category": {
     *          "id": 1,
     *          "name": "Fresh Fish",
     *          "display_name": "Fresh Fish",
     *          "description": "Fresh fish products"
     *        },
     *        "created_at": "2024-02-11T18:24:59.000000Z",
     *        "updated_at": "2024-02-11T18:24:59.000000Z"
     *      }
     *    ]
     *  }
     */
    public function index()
    {
        return ProductResource::collection(Cache::rememberForever('products', function () {
            return Product::with('category')->get();
        }));
    }

    /**
     * Get a specific product.
     *
     * @group Products V2
     *
     * @urlParam product int required The ID of the product. Example: 1
     *
     * @response 200 {
     *     "data": {
     *       "id": 1,
     *       "name": "Fresh Salmon",
     *       "category_id": 1,
     *       "price_per_kg": 25.99,
     *       "stock_kg": 100.5,
     *       "description": "Fresh Atlantic Salmon",
     *       "category": {
     *         "id": 1,
     *         "name": "Fresh Fish",
     *         "display_name": "Fresh Fish",
     *         "description": "Fresh fish products"
     *       },
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function show(Product $product)
    {
        return new ProductResource($product->load('category'));
    }

    /**
     * Store a new product.
     *
     * @group Products V2
     *
     * @bodyParam name string required The name of the product. Example: Fresh Salmon
     * @bodyParam category_id integer required The ID of the category. Example: 1
     * @bodyParam price_per_kg numeric required The price per kilogram. Example: 25.99
     * @bodyParam stock_kg numeric required The stock in kilograms. Example: 100.5
     * @bodyParam description string A description of the product. Example: Fresh Atlantic Salmon
     *
     * @response 201 {
     *     "data": {
     *       "id": 1,
     *       "name": "Fresh Salmon",
     *       "category_id": 1,
     *       "price_per_kg": 25.99,
     *       "stock_kg": 100.5,
     *       "description": "Fresh Atlantic Salmon",
     *       "category": {
     *         "id": 1,
     *         "name": "Fresh Fish",
     *         "display_name": "Fresh Fish",
     *         "description": "Fresh fish products"
     *       },
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        Cache::forget('products');

        return new ProductResource($product->load('category'));
    }

    /**
     * Update an existing product.
     *
     * @group Products V2
     *
     * @urlParam product int required The ID of the product. Example: 1
     *
     * @bodyParam name string required The name of the product. Example: Fresh Salmon
     * @bodyParam category_id integer required The ID of the category. Example: 1
     * @bodyParam price_per_kg numeric required The price per kilogram. Example: 25.99
     * @bodyParam stock_kg numeric required The stock in kilograms. Example: 100.5
     * @bodyParam description string A description of the product. Example: Fresh Atlantic Salmon
     *
     * @response 200 {
     *     "data": {
     *       "id": 1,
     *       "name": "Fresh Salmon",
     *       "category_id": 1,
     *       "price_per_kg": 25.99,
     *       "stock_kg": 100.5,
     *       "description": "Fresh Atlantic Salmon",
     *       "category": {
     *         "id": 1,
     *         "name": "Fresh Fish",
     *         "display_name": "Fresh Fish",
     *         "description": "Fresh fish products"
     *       },
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        Cache::forget('products');

        return new ProductResource($product->load('category'));
    }

    /**
     * Delete a product.
     *
     * @group Products V2
     *
     * @urlParam product int required The ID of the product. Example: 1
     *
     * @response 204
     */
    public function destroy(Product $product)
    {
        $product->delete();
        Cache::forget('products');

        return response()->json(null, 204);
    }
} 