<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Get a list of all categories.
     *
     * @group Categories V2
     *
     * @response 200 {
     *    "data": [
     *      {
     *        "id": 1,
     *        "name": "Fresh Fish",
     *        "display_name": "Fresh Fish",
     *        "description": "Fresh fish products",
     *        "created_at": "2024-02-11T18:24:59.000000Z",
     *        "updated_at": "2024-02-11T18:24:59.000000Z"
     *      }
     *    ]
     *  }
     */
    public function index()
    {
        return CategoryResource::collection(Cache::rememberForever('categories', function () {
            return Category::all();
        }));
    }

    /**
     * Get a specific category.
     *
     * @group Categories V2
     *
     * @urlParam category int required The ID of the category. Example: 1
     *
     * @response 200 {
     *     "data": {
     *       "id": 1,
     *       "name": "Fresh Fish",
     *       "display_name": "Fresh Fish",
     *       "description": "Fresh fish products",
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Store a new category.
     *
     * @group Categories V2
     *
     * @bodyParam name string required The name of the category. Example: Fresh Fish
     * @bodyParam display_name string required The display name of the category. Example: Fresh Fish
     * @bodyParam description string A description of the category. Example: Fresh fish products
     *
     * @response 201 {
     *     "data": {
     *       "id": 1,
     *       "name": "Fresh Fish",
     *       "display_name": "Fresh Fish",
     *       "description": "Fresh fish products",
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        Cache::forget('categories');

        return new CategoryResource($category);
    }

    /**
     * Update an existing category.
     *
     * @group Categories V2
     *
     * @urlParam category int required The ID of the category. Example: 1
     *
     * @bodyParam name string required The name of the category. Example: Fresh Fish
     * @bodyParam display_name string required The display name of the category. Example: Fresh Fish
     * @bodyParam description string A description of the category. Example: Fresh fish products
     *
     * @response 200 {
     *     "data": {
     *       "id": 1,
     *       "name": "Fresh Fish",
     *       "display_name": "Fresh Fish",
     *       "description": "Fresh fish products",
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        Cache::forget('categories');

        return new CategoryResource($category);
    }

    /**
     * Delete a category.
     *
     * @group Categories V2
     *
     * @urlParam category int required The ID of the category. Example: 1
     *
     * @response 204
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Cache::forget('categories');

        return response()->json(null, 204);
    }
} 