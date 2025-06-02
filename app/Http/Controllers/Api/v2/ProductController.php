<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Get a list of all products.
     *
     * @group Products V2
     *
     * @response 200 {"data": [{"id": 1, "name": "Salmon", "description": "Fresh salmon", "price": 19.99, "stock": 100, "category": {"id": 1, "name": "freshwater", "display_name": "Freshwater Fish"}}]}
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::with('category')->get();
        return ProductResource::collection($products);
    }

    /**
     * Get a specific product.
     *
     * @group Products V2
     *
     * @urlParam product int required The ID of the product. Example: 1
     *
     * @response 200 {"data": {"id": 1, "name": "Salmon", "description": "Fresh salmon", "price": 19.99, "stock": 100, "category": {"id": 1, "name": "freshwater", "display_name": "Freshwater Fish"}}}
     * @response 404 {"message": "Product not found"}
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product->load('category'));
    }

    /**
     * Store a new product.
     *
     * @group Products V2
     *
     * @bodyParam name string required The name of the product. Example: Salmon
     * @bodyParam description string required The description of the product. Example: Fresh salmon
     * @bodyParam price number required The price of the product. Example: 19.99
     * @bodyParam stock integer required The stock quantity. Example: 100
     * @bodyParam category_id integer required The ID of the category. Example: 1
     *
     * @response 201 {"data": {"id": 1, "name": "Salmon", "description": "Fresh salmon", "price": 19.99, "stock": 100, "category": {"id": 1, "name": "freshwater", "display_name": "Freshwater Fish"}}}
     */
    public function store(StoreProductRequest $request): ProductResource
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
     * @bodyParam name string required The name of the product. Example: Salmon
     * @bodyParam description string required The description of the product. Example: Fresh salmon
     * @bodyParam price number required The price of the product. Example: 19.99
     * @bodyParam stock integer required The stock quantity. Example: 100
     * @bodyParam category_id integer required The ID of the category. Example: 1
     *
     * @response 200 {"data": {"id": 1, "name": "Updated Salmon", "description": "Updated description", "price": 24.99, "stock": 50, "category": {"id": 1, "name": "freshwater", "display_name": "Freshwater Fish"}}}
     * @response 404 {"message": "Product not found"}
     */
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $product->update($request->validated());
        Cache::forget('products');

        return new ProductResource($product->load('category'));
    }

    /**
     * Delete a specific product.
     *
     * @group Products V2
     *
     * @urlParam product int required The ID of the product. Example: 1
     *
     * @response 204 {"message": "Product deleted successfully"}
     * @response 404 {"message": "Product not found"}
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        Cache::forget('products');

        return response()->json(['message' => 'Product deleted successfully'], 204);
    }
} 