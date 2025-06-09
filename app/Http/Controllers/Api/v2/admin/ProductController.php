<?php

namespace App\Http\Controllers\Api\v2\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    use AuthorizesRequests;

//    /**
//     * Get a list of all products.
//     *
//     * @group Products V2
//     *
//     * @response 200 {
//     *    "data": [
//     *      {
//     *        "id": 1,
//     *        "name": "Salmon",
//     *        "description": "Fresh salmon from local waters",
//     *        "price": 19.99,
//     *        "stock": 100,
//     *        "category": {
//     *          "id": 1,
//     *          "name": "Frozen",
//     *          "display_name": "Frozen Fish"
//     *        }
//     *      }
//     *    ]
//     * }
//     */
//    public function index(): AnonymousResourceCollection
//    {
//        $this->authorize('viewAny', Product::class);
//
//        return ProductResource::collection(Cache::rememberForever('products', function () {
//            return Product::with(['category', 'fishes'])->get();
//        }));
//    }
//
//    /**
//     * Get a specific product.
//     *
//     * @group Products V2
//     *
//     * @urlParam product int required The ID of the product. Example: 1
//     *
//     * @response 200 {
//     *    "data": {
//     *      "id": 1,
//     *      "name": "Salmon",
//     *      "description": "Fresh salmon from local waters",
//     *      "price": 19.99,
//     *      "stock": 100,
//     *      "category": {
//     *        "id": 1,
//     *        "name": "Frozen",
//     *        "display_name": "Frozen Fish"
//     *      }
//     *    }
//     * }
//     * @response 404 {"message": "Product not found"}
//     */
//    public function show(Product $product): ProductResource
//    {
//        $this->authorize('view', $product);
//
//        return new ProductResource($product->load('category', 'fishes'));
//    }

    /**
     * Store a new product.
     *
     * @group Products V2
     *
     * @authenticated
     *
     * @bodyParam name string required The name of the product. Example: Salmon
     * @bodyParam description string required A detailed description of the product. Example: Fresh salmon from local waters, caught and processed within 24 hours.
     * @bodyParam price number required The price of the product in dollars. Example: 19.99
     * @bodyParam stock integer required The current stock quantity. Example: 100
     * @bodyParam category_id integer required The ID of the category this product belongs to. Example: 1
     * @bodyParam fishes array optional Array of fish relationships. Example: [{"fish_id": 1, "days_on_sale": 5, "supplier": "Local Fishery"}]
     * @bodyParam fishes.*.fish_id integer required The ID of the fish. Example: 1
     * @bodyParam fishes.*.days_on_sale integer optional Number of days the fish will be on sale. Example: 5
     * @bodyParam fishes.*.supplier string optional Name of the supplier. Example: "Local Fishery"
     *
     * @response 201 {
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
     *      },
     *      "fishes": [
     *        {
     *          "id": 1,
     *          "name": "Atlantic Salmon",
     *          "pivot": {
     *            "days_on_sale": 5,
     *            "supplier": "Local Fishery"
     *          }
     *        }
     *      ]
     *    }
     * }
     * @response 422 {"message": "The given data was invalid.", "errors": {"name": ["The name field is required."]}}
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $this->authorize('create', Product::class);

        $product = Product::create($request->validated());

        if ($request->has('fishes')) {
            $fishData = collect($request->fishes)->mapWithKeys(function ($fish) {
                return [$fish['fish_id'] => [
                    'days_on_sale' => $fish['days_on_sale'] ?? null,
                    'supplier' => $fish['supplier'] ?? null,
                ]];
            })->all();

            $product->fishes()->syncWithoutDetaching($fishData);
        }

        Cache::forget('products');

        return new ProductResource($product->load(['category', 'fishes']));
    }

    /**
     * Update an existing product.
     *
     * @group Products V2
     *
     * @authenticated
     *
     * @urlParam product int required The ID of the product. Example: 1
     *
     * @bodyParam name string required The name of the product. Example: Salmon
     * @bodyParam description string required A detailed description of the product. Example: Fresh salmon from local waters, caught and processed within 24 hours.
     * @bodyParam price number required The price of the product in dollars. Example: 19.99
     * @bodyParam stock integer required The current stock quantity. Example: 100
     * @bodyParam category_id integer required The ID of the category this product belongs to. Example: 1
     * @bodyParam fishes array optional Array of fish relationships. Example: [{"fish_id": 1, "days_on_sale": 5, "supplier": "Local Fishery"}]
     * @bodyParam fishes.*.fish_id integer required The ID of the fish. Example: 1
     * @bodyParam fishes.*.days_on_sale integer optional Number of days the fish will be on sale. Example: 5
     * @bodyParam fishes.*.supplier string optional Name of the supplier. Example: "Local Fishery"
     *
     * @response 200 {
     *    "data": {
     *      "id": 1,
     *      "name": "Updated Salmon",
     *      "description": "Updated description",
     *      "price": 24.99,
     *      "stock": 50,
     *      "category": {
     *        "id": 1,
     *        "name": "Frozen",
     *        "display_name": "Frozen Fish"
     *      },
     *      "fishes": [
     *        {
     *          "id": 1,
     *          "name": "Atlantic Salmon",
     *          "pivot": {
     *            "days_on_sale": 5,
     *            "supplier": "Local Fishery"
     *          }
     *        }
     *      ]
     *    }
     * }
     * @response 404 {"message": "Product not found"}
     * @response 422 {"message": "The given data was invalid.", "errors": {"name": ["The name field is required."]}}
     */
    public function update(Product $product, StoreProductRequest $request): ProductResource
    {
        $this->authorize('update', $product);

        $product->update($request->validated());

        if ($request->has('fishes')) {
            $fishData = collect($request->fishes)->mapWithKeys(function ($fish) {
                return [$fish['fish_id'] => [
                    'days_on_sale' => $fish['days_on_sale'] ?? null,
                    'supplier' => $fish['supplier'] ?? null,
                ]];
            })->all();

            $product->fishes()->sync($fishData);
        }

        Cache::forget('products');

        return new ProductResource($product->load(['category', 'fishes']));
    }

    /**
     * Delete a specific product.
     *
     * @group Products V2
     *
     * @authenticated
     *
     * @urlParam product int required The ID of the product. Example: 1
     *
     * @response 204 {"message": "Product deleted successfully"}
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);

        $product->delete();
        Cache::forget('products');

        return response()->json(['message' => __('Product deleted successfully')], 204);
    }
}
