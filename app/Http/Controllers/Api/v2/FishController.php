<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFishRequest;
use App\Http\Resources\FishResource;
use App\Models\Fish;
use App\Models\TypeWater;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FishController extends Controller
{
    /***
     *
     *
     *
     */
    /**
     * Get a list of all fishes.
     *
     * @group Fishes V2
     *
     * @response 200 {
     *    "data": [
     *      {
     *        "id": 1,
     *        "name": "Salmon",
     *        "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *        "type": ["Freshwater"],
     *        "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore."
     *        "state": "forbidden",
     *        "temperature_range": "20-25°C",
     *        "ph_range": "7.0-8.0",
     *        "salinity": "1.03",
     *        "oxygen_level": "5.94",
     *        "notes": "Quo illo facere odio et sed. Beatae et fuga accusantium optio rerum. Sit vero eaque iste tenetur eum. Enim dolor et reprehenderit eligendi et repudiandae qui."
     *      },
     *      {
     *         "id": 2,
     *         "name": "Trucha",
     *         "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *         "type": ["Saltwater"],
     *         "description": "Et eum iste impedit consequatur atque natus. Neque asperiores cum sunt nulla adipisci qui ad. Aut qui maiores quia velit facilis sint ut. Incidunt quod ducimus eos id.",
     *         "state": "allowed",
     *         "temperature_range": "24-30°C",
     *         "ph_range": "6.5-7.5",
     *         "salinity": "1.02",
     *         "oxygen_level": "5.26",
     *         "notes": "Placeat delectus facere dolor dolorem. Repudiandae veniam ex neque et."
     *       }
     *    ]
     *  }
     *
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
     * @group Fishes V2
     *
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @response 200 {
     *     "data": [
     *       {
     *         "id": 1,
     *         "name": "Salmon",
     *         "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *         "type": ["Freshwater"],
     *         "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore."
     *         "state": "forbidden",
     *         "temperature_range": "20-25°C",
     *         "ph_range": "7.0-8.0",
     *         "salinity": "1.03",
     *         "oxygen_level": "5.94",
     *         "notes": "Quo illo facere odio et sed. Beatae et fuga accusantium optio rerum. Sit vero eaque iste tenetur eum. Enim dolor et reprehenderit eligendi et repudiandae qui."
     *       }
     *    ]
     *}
     */
    public function show(Fish $fish)
    {
        return new FishResource($fish);
    }

    /**
     * Store a new fish.
     *
     * @group Fishes V2
     *
     * @bodyParam name string required The name of the fish. Example: Salmon
     * @bodyParam type string required The type of the fish. Example: Freshwater
     * @bodyParam price number required The price of the fish. Example: 10.5
     *
     * @response 201 {
     *      "data": [
     *        {
     *          "id": 1,
     *          "name": "Salmon",
     *          "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *          "type": ["Freshwater"],
     *          "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore."
     *          "state": "forbidden",
     *          "temperature_range": "20-25°C",
     *          "ph_range": "7.0-8.0",
     *          "salinity": "1.03",
     *          "oxygen_level": "5.94",
     *          "notes": "Quo illo facere odio et sed. Beatae et fuga accusantium optio rerum. Sit vero eaque iste tenetur eum. Enim dolor et reprehenderit eligendi et repudiandae qui."
     *        }
     *     ]
     * }
     *
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
     * @group Fishes V2
     *
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @bodyParam name string required The name of the fish. Example: Salmon
     * @bodyParam type string required The type of the fish. Example: Freshwater
     *
     * @response 201 {
     *      "data": [
     *        {
     *          "id": 1,
     *          "name": "Updated Salmon",
     *          "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *          "type": ["Freshwater"],
     *          "description": "Et consectetur nisi excepturi esse aut. Minima quae mollitia corporis ut qui. Iusto velit aut fugit incidunt quam facere. Consequatur vel quia iste illum tempore."
     *          "state": "forbidden",
     *          "temperature_range": "20-25°C",
     *          "ph_range": "7.0-8.0",
     *          "salinity": "1.03",
     *          "oxygen_level": "5.94",
     *          "notes": "Quo illo facere odio et sed. Beatae et fuga accusantium optio rerum. Sit vero eaque iste tenetur eum. Enim dolor et reprehenderit eligendi et repudiandae qui."
     *        }
     *     ]
     * }
     *
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
     * @group Fishes V2
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
