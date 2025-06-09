<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFishRequest;
use App\Http\Resources\FishResource;
use App\Models\Fish;
use App\Models\TypeWater;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * @deprecated This controller is deprecated and will be removed in a future release.
 * Please use App\Http\Controllers\Api\v2\auth\FishController instead.
 */
class FishController extends Controller
{
    use AuthorizesRequests;

    /**
     * Get a list of all fishes.
     *
     * @group Fishes V1
     *
     * @deprecated Use v2 API endpoint instead
     *
     * @response 200 {
     *    "data": [
     *      {
     *        "id": 1,
     *        "name": "Salmon",
     *        "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *        "type": ["Freshwater"],
     *        "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui."
     *      }
     *    ]
     * }
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('viewAny', Fish::class);

        return FishResource::collection(Cache::rememberForever('fishes', function () {
            return Fish::all();
        }));
    }

    /**
     * Get a specific fish.
     *
     * @group Fishes V1
     *
     * @deprecated Use v2 API endpoint instead
     *
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @response 200 {
     *    "data": {
     *      "id": 1,
     *      "name": "Salmon",
     *      "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *      "type": ["Freshwater"],
     *      "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui."
     *    }
     * }
     */
    public function show(Fish $fish): FishResource
    {
        $this->authorize('view', $fish);

        return new FishResource($fish);
    }

    /**
     * Store a new fish.
     *
     * @group Fishes V1
     *
     * @authenticated
     *
     * @deprecated Use v2 API endpoint instead
     *
     * @bodyParam name string required The name of the fish. Example: Salmon
     * @bodyParam type string required The type of water where the fish lives (Freshwater or Saltwater). Example: Freshwater
     * @bodyParam price number required The price of the fish in dollars. Example: 10.5
     * @bodyParam description string required A detailed description of the fish. Example: A popular fish known for its pink flesh and rich flavor.
     * @bodyParam photo file The image file of the fish. Must be a valid image file (jpg, png, gif).
     *
     * @response 201 {
     *    "data": {
     *      "id": 1,
     *      "name": "Salmon",
     *      "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *      "type": ["Freshwater"],
     *      "description": "A popular fish known for its pink flesh and rich flavor."
     *    }
     * }
     */
    public function store(StoreFishRequest $request): FishResource
    {
        $this->authorize('create', Fish::class);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::uuid().'.'.$file->extension();
            $file->storeAs('fishes', $name, 'public');
            $data['photo'] = $name;
        }

        $fish = Fish::create($data);
        $typeWater = TypeWater::firstOrCreate(['type' => $request->input('type')]);

        if ($typeWater) {
            $fish->typeWater()->attach($typeWater->id);
        }

        return new FishResource($fish);
    }

    /**
     * Update an existing fish.
     *
     * @group Fishes V1
     *
     * @authenticated
     *
     * @deprecated Use v2 API endpoint instead
     *
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @bodyParam name string required The name of the fish. Example: Salmon
     * @bodyParam type string required The type of water where the fish lives (Freshwater or Saltwater). Example: Freshwater
     * @bodyParam description string required A detailed description of the fish. Example: A popular fish known for its pink flesh and rich flavor.
     * @bodyParam photo file The image file of the fish. Must be a valid image file (jpg, png, gif).
     *
     * @response 200 {
     *    "data": {
     *      "id": 1,
     *      "name": "Updated Salmon",
     *      "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *      "type": ["Freshwater"],
     *      "description": "Updated description of the fish."
     *    }
     * }
     */
    public function update(Fish $fish, StoreFishRequest $request): FishResource
    {
        $this->authorize('update', $fish);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'image' => 'nullable',
        ]);

        $fish->update($request->all());

        return new FishResource($fish);
    }

    /**
     * Delete a specific fish.
     *
     * @group Fishes V1
     *
     * @authenticated
     *
     * @deprecated Use v2 API endpoint instead
     *
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @response 204 {"message": "Fish deleted successfully"}
     */
    public function destroy(Fish $fish): JsonResponse
    {
        $this->authorize('delete', $fish);

        $fish->delete();

        return response()->json(['message' => __('Fish deleted successfully')], 200);
    }
}
