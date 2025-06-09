<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    use AuthorizesRequests;

    /**
     * Get a list of all products.
     *
     * @group Products V2
     *
     * @response 200 {
     *    "data": [
     *      {
     *        "id": 1,
     *        "name": "Salmon",
     *        "description": "Fresh salmon from local waters",
     *        "price": 19.99,
     *        "stock": 100,
     *        "category": {
     *          "id": 1,
     *          "name": "Frozen",
     *          "display_name": "Frozen Fish"
     *        }
     *      }
     *    ]
     * }
     */
    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Product::class);

        return ProductResource::collection(Cache::rememberForever('products', function () {
            return Product::with(['category', 'fishes'])->get();
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
     *    "data": {
     *      "id": 1,
     *      "name": "Salmon",
     *      "description": "Fresh salmon from local waters",
     *      "price": 19.99,
     *      "stock": 100,
     *      "category": {
     *        "id": 1,
     *        "name": "Frozen",
     *        "display_name": "Frozen Fish"
     *      }
     *    }
     * }
     * @response 404 {"message": "Product not found"}
     */
    public function show(Product $product): ProductResource
    {
        $this->authorize('view', $product);

        return new ProductResource($product->load('category', 'fishes'));
    }
}
