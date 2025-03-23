<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFishRequest;
use App\Http\Resources\FishResource;
use App\Models\Fish;
use App\Models\TypeWater;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FishController extends Controller
{
    /**
     * Get a list of all fishes.
     *
     * @group Fishes V1
     *
     * @response 200 {"data": [{"id": 1, "name": "Salmon", "image": "https://via.placeholder.com/640x480.png/007777?text=sint", "type": ["Freshwater"], "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore."}]}
     */
    public function index()
    {
        return FishResource::collection(Cache::rememberForever('fishes', function () {
            return Fish::all();
        }));
    }

    /**
     * Get a specific fish.
     *
     * @group Fishes V1
     *
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @response 200 {"id": 1, "name": "Salmon", "image": "https://via.placeholder.com/640x480.png/007777?text=sint", "type": ["Freshwater"], "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore."}
     */
    public function show(Fish $fish)
    {
        return new FishResource($fish);
    }

    /**
     * Store a new fish.
     *
     * @group Fishes V1
     *
     * @bodyParam name string required The name of the fish. Example: Salmon
     * @bodyParam type string required The type of the fish. Example: Freshwater
     * @bodyParam price number required The price of the fish. Example: 10.5
     *
     * @response 201 {"id": 1, "name": "Salmon", "image": "https://via.placeholder.com/640x480.png/007777?text=sint", "type": ["Freshwater"], "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore."}
     */
    public function store(StoreFishRequest $request)
    {
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
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @bodyParam name string required The name of the fish. Example: Salmon
     * @bodyParam type string required The type of the fish. Example: Freshwater
     *
     * @response 200 {"id": 1, "name": "Updated Salmon", "image": "https://via.placeholder.com/640x480.png/007777?text=sint", "type": ["Freshwater"], "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore."}
     */
    public function update(Fish $fish, StoreFishRequest $request)
    {
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
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @response 204 {"message": "Fish deleted successfully"}
     */
    public function destroy(Fish $fish)
    {
        $fish->delete();

        return response()->json(['message' => 'Fish deleted successfully'], 200);
    }
}
