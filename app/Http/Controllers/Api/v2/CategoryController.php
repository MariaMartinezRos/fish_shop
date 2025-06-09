<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    use AuthorizesRequests;

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
        $this->authorize('viewAny', Category::class);

        $categories = Category::all();

        return CategoryResource::collection($categories);
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
        $this->authorize('view', $category);

        return new CategoryResource($category);
    }
}
