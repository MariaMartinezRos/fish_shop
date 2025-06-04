<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     *        "name": "Frozen",
     *        "display_name": "Frozen Fish",
     *        "description": "Fish that live in freshwater environments"
     *      }
     *    ]
     * }
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a new category.
     *
     * @group Categories V2
     *
     * @bodyParam name string required The unique identifier of the category (lowercase, no spaces). Example: freshwater
     * @bodyParam display_name string required The human-readable name of the category. Example: Freshwater Fish
     * @bodyParam description string required A detailed description of the category and its characteristics. Example: Fish that live in freshwater environments such as rivers, lakes, and ponds.
     *
     * @response 201 {
     *    "data": {
     *      "id": 1,
     *      "name": "Frozen",
     *      "display_name": "Frozen Fish",
     *      "description": "Fish that live in freshwater environments"
     *    }
     * }
     * @response 422 {"message": "The given data was invalid.", "errors": {"name": ["The name field is required."]}}
     */
    public function store(StoreCategoryRequest $request): CategoryResource
    {
        $category = Category::create($request->validated());

        return new CategoryResource($category);
    }

    /**
     * Get a specific category.
     *
     * @group Categories V2
     *
     * @authenticated
     *
     * @urlParam category int required The ID of the category. Example: 1
     *
     * @response 200 {
     *    "data": {
     *      "id": 1,
     *      "name": "Frozen",
     *      "display_name": "Frozen Fish",
     *      "description": "Fish that live in freshwater environments"
     *    }
     * }
     * @response 404 {"message": "Category not found"}
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * Update an existing category.
     *
     * @group Categories V2
     *
     * @authenticated
     *
     * @urlParam category int required The ID of the category. Example: 1
     *
     * @bodyParam display_name string required The human-readable name of the category. Example: Freshwater Fish
     * @bodyParam description string required A detailed description of the category and its characteristics. Example: Fish that live in freshwater environments such as rivers, lakes, and ponds.
     *
     * @response 200 {
     *    "data": {
     *      "id": 1,
     *      "name": "Frozen",
     *      "display_name": "Updated Frozen Fish",
     *      "description": "Updated description of freshwater fish and their habitats"
     *    }
     * }
     * @response 404 {"message": "Category not found"}
     * @response 422 {"message": "The given data was invalid.", "errors": {"display_name": ["The display name field is required."]}}
     */
    public function update(UpdateCategoryRequest $request, Category $category): CategoryResource
    {
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    /**
     * Delete a specific category.
     *
     * @group Categories V2
     *
     * @authenticated
     *
     * @urlParam category int required The ID of the category. Example: 1
     *
     * @response 204 {"message": "Category deleted successfully"}
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(['message' => __('Category deleted successfully')], 204);
    }
}
