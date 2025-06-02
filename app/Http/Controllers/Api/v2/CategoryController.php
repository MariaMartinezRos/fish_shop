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
     * @response 200 {"data": [{"id": 1, "name": "Freshwater", "display_name": "Freshwater Fish", "description": "Fish that live in freshwater environments"}]}
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
     * @bodyParam name string required The unique identifier of the category. Example: freshwater
     * @bodyParam display_name string required The display name of the category. Example: Freshwater Fish
     * @bodyParam description string required The description of the category. Example: Fish that live in freshwater environments
     *
     * @response 201 {"data": {"id": 1, "name": "freshwater", "display_name": "Freshwater Fish", "description": "Fish that live in freshwater environments"}}
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
     * @urlParam category int required The ID of the category. Example: 1
     *
     * @response 200 {"data": {"id": 1, "name": "freshwater", "display_name": "Freshwater Fish", "description": "Fish that live in freshwater environments"}}
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
     * @urlParam category int required The ID of the category. Example: 1
     *
     * @bodyParam display_name string required The display name of the category. Example: Freshwater Fish
     * @bodyParam description string required The description of the category. Example: Fish that live in freshwater environments
     *
     * @response 200 {"data": {"id": 1, "name": "freshwater", "display_name": "Updated Freshwater Fish", "description": "Updated description"}}
     * @response 404 {"message": "Category not found"}
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
     * @urlParam category int required The ID of the category. Example: 1
     *
     * @response 204 {"message": "Category deleted successfully"}
     * @response 404 {"message": "Category not found"}
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 204);
    }
} 