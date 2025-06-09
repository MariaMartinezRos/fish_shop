<?php

namespace App\Http\Controllers\Api\v2;

use App\Events\FishAdded;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFishRequest;
use App\Http\Resources\FishResource;
use App\Models\Fish;
use App\Models\TypeWater;
use App\Policies\FishPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FishController extends Controller
{
    use AuthorizesRequests;

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
     *        "scientific_name": "Salmo salar",
     *        "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *        "description": "Et consectetur nisi excepturi esse aut.",
     *        "average_size_cm": 75.5,
     *        "diet": "Carnivore",
     *        "lifespan_years": 7,
     *        "habitat": "Rivers and Oceans",
     *        "conservation_status": "Least Concern",
     *        "type": ["Freshwater", "Saltwater"],
     *        "characteristics": {
     *          "state": "Allowed",
     *          "temperature_range": "20-25°C",
     *          "ph_range": "7.0-8.0",
     *          "salinity": 1.03,
     *          "oxygen_level": 5.94,
     *          "migration_pattern": "Anadromous",
     *          "recorded_since": 1990,
     *          "notes": "Quo illo facere odio et sed."
     *        },
     *        "water_type_details": {
     *          "type": "Freshwater",
     *          "ph_level": 7.2,
     *          "temperature_range": "10-25°C",
     *          "salinity_level": 0.05,
     *          "region": "Rivers, Lakes, Ponds",
     *          "description": "Water with low salt concentration"
     *        },
     *        "created_at": "2024-02-11T18:24:59.000000Z",
     *        "updated_at": "2024-02-11T18:24:59.000000Z"
     *      }
     *    ]
     * }
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('viewAny', Fish::class);

        return FishResource::collection(Cache::rememberForever('fishes', function () {
            return Fish::with('typeWater')->get();
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
     *     "data": {
     *       "id": 1,
     *       "name": "Salmon",
     *       "scientific_name": "Salmo salar",
     *       "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *       "description": "Et consectetur nisi excepturi esse aut.",
     *       "average_size_cm": 75.5,
     *       "diet": "Carnivore",
     *       "lifespan_years": 7,
     *       "habitat": "Rivers and Oceans",
     *       "conservation_status": "Least Concern",
     *       "type": ["Freshwater", "Saltwater"],
     *       "characteristics": {
     *         "state": "Allowed",
     *         "temperature_range": "20-25°C",
     *         "ph_range": "7.0-8.0",
     *         "salinity": 1.03,
     *         "oxygen_level": 5.94,
     *         "migration_pattern": "Anadromous",
     *         "recorded_since": 1990,
     *         "notes": "Quo illo facere odio et sed."
     *       },
     *       "water_type_details": {
     *         "type": "Freshwater",
     *         "ph_level": 7.2,
     *         "temperature_range": "10-25°C",
     *         "salinity_level": 0.05,
     *         "region": "Rivers, Lakes, Ponds",
     *         "description": "Water with low salt concentration"
     *       },
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function show(Fish $fish): FishResource
    {
        $this->authorize('view', $fish);

        return new FishResource($fish->load('typeWater'));
    }

    /**
     * Store a new fish.
     *
     * @group Fishes V2
     *
     * @authenticated
     *
     * @bodyParam name string required The common name of the fish. Example: Salmon
     * @bodyParam scientific_name string required The scientific name of the fish. Example: Salmo salar
     * @bodyParam image file The image file of the fish. Must be a valid image file (jpg, png, gif).
     * @bodyParam description string required A detailed description of the fish's characteristics and behavior.
     * @bodyParam average_size_cm numeric The average size of the fish in centimeters.
     * @bodyParam diet string required The diet type of the fish (Carnivore, Herbivore, Omnivore).
     * @bodyParam lifespan_years integer The typical lifespan of the fish in years.
     * @bodyParam habitat string required The natural habitat where the fish is commonly found.
     * @bodyParam conservation_status string required The conservation status of the fish (e.g., Least Concern, Endangered).
     * @bodyParam type string required The type of water where the fish lives (Saltwater, Freshwater).
     * @bodyParam characteristics array required The water characteristics required for the fish.
     * @bodyParam characteristics.state string required The state of the fish (Allowed, Forbidden, Biological rest).
     * @bodyParam characteristics.temperature_range string required The optimal temperature range for the fish.
     * @bodyParam characteristics.ph_range string required The optimal pH range for the fish.
     * @bodyParam characteristics.salinity numeric The optimal salinity level for the fish.
     * @bodyParam characteristics.oxygen_level numeric The required oxygen level for the fish.
     * @bodyParam characteristics.migration_pattern string required The migration pattern of the fish.
     * @bodyParam characteristics.recorded_since integer The year when the fish was first recorded.
     * @bodyParam characteristics.notes string Additional notes about the fish's characteristics.
     *
     * @response 201 {
     *     "data": {
     *       "id": 1,
     *       "name": "Salmon",
     *       "scientific_name": "Salmo salar",
     *       "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *       "description": "Et consectetur nisi excepturi esse aut.",
     *       "average_size_cm": 75.5,
     *       "diet": "Carnivore",
     *       "lifespan_years": 7,
     *       "habitat": "Rivers and Oceans",
     *       "conservation_status": "Least Concern",
     *       "type": ["Freshwater", "Saltwater"],
     *       "characteristics": {
     *         "state": "Allowed",
     *         "temperature_range": "20-25°C",
     *         "ph_range": "7.0-8.0",
     *         "salinity": 1.03,
     *         "oxygen_level": 5.94,
     *         "migration_pattern": "Anadromous",
     *         "recorded_since": 1990,
     *         "notes": "Quo illo facere odio et sed."
     *       },
     *       "water_type_details": {
     *         "type": "Freshwater",
     *         "ph_level": 7.2,
     *         "temperature_range": "10-25°C",
     *         "salinity_level": 0.05,
     *         "region": "Rivers, Lakes, Ponds",
     *         "description": "Water with low salt concentration"
     *       },
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function store(StoreFishRequest $request): FishResource
    {
        $this->authorize('create', Fish::class);

        $data = $request->validated();
        $characteristics = $data['characteristics'];
        unset($data['characteristics']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = Str::uuid().'.'.$file->extension();
            $file->storeAs('fishes', $name, 'public');
            $data['image'] = $name;
        }

        $fish = Fish::create($data);
        $typeWater = TypeWater::firstOrCreate(['type' => $request->input('type')]);

        if ($typeWater) {
            $fish->typeWater()->attach($typeWater->id, $characteristics);
        }

        Cache::forget('fishes');

        event(new FishAdded($fish));

        return new FishResource($fish->load('typeWater'));
    }

    /**
     * Update an existing fish.
     *
     * @group Fishes V2
     *
     * @authenticated
     *
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @bodyParam name string required The common name of the fish. Example: Salmon
     * @bodyParam scientific_name string required The scientific name of the fish. Example: Salmo salar
     * @bodyParam image file The image file of the fish. Must be a valid image file (jpg, png, gif).
     * @bodyParam description string required A detailed description of the fish's characteristics and behavior.
     * @bodyParam average_size_cm numeric The average size of the fish in centimeters.
     * @bodyParam diet string required The diet type of the fish (Carnivore, Herbivore, Omnivore).
     * @bodyParam lifespan_years integer The typical lifespan of the fish in years.
     * @bodyParam habitat string required The natural habitat where the fish is commonly found.
     * @bodyParam conservation_status string required The conservation status of the fish (e.g., Least Concern, Endangered).
     * @bodyParam type string required The type of water where the fish lives (Saltwater, Freshwater).
     * @bodyParam characteristics array required The water characteristics required for the fish.
     * @bodyParam characteristics.state string required The state of the fish (Allowed, Forbidden, Biological rest).
     * @bodyParam characteristics.temperature_range string required The optimal temperature range for the fish.
     * @bodyParam characteristics.ph_range string required The optimal pH range for the fish.
     * @bodyParam characteristics.salinity numeric The optimal salinity level for the fish.
     * @bodyParam characteristics.oxygen_level numeric The required oxygen level for the fish.
     * @bodyParam characteristics.migration_pattern string required The migration pattern of the fish.
     * @bodyParam characteristics.recorded_since integer The year when the fish was first recorded.
     * @bodyParam characteristics.notes string Additional notes about the fish's characteristics.
     *
     * @response 200 {
     *     "data": {
     *       "id": 1,
     *       "name": "Updated Salmon",
     *       "scientific_name": "Salmo salar",
     *       "image": "https://via.placeholder.com/640x480.png/007777?text=sint",
     *       "description": "Updated description",
     *       "average_size_cm": 80.0,
     *       "diet": "Carnivore",
     *       "lifespan_years": 8,
     *       "habitat": "Updated habitat",
     *       "conservation_status": "Least Concern",
     *       "type": ["Freshwater", "Saltwater"],
     *       "characteristics": {
     *         "state": "Allowed",
     *         "temperature_range": "22-28°C",
     *         "ph_range": "7.2-8.0",
     *         "salinity": 1.02,
     *         "oxygen_level": 6.0,
     *         "migration_pattern": "Anadromous",
     *         "recorded_since": 1990,
     *         "notes": "Updated notes"
     *       },
     *       "water_type_details": {
     *         "type": "Freshwater",
     *         "ph_level": 7.2,
     *         "temperature_range": "10-25°C",
     *         "salinity_level": 0.05,
     *         "region": "Rivers, Lakes, Ponds",
     *         "description": "Water with low salt concentration"
     *       },
     *       "created_at": "2024-02-11T18:24:59.000000Z",
     *       "updated_at": "2024-02-11T18:24:59.000000Z"
     *     }
     * }
     */
    public function update(Fish $fish, StoreFishRequest $request): FishResource
    {
        $this->authorize('update', $fish);

        $data = $request->validated();
        $characteristics = $data['characteristics'];
        unset($data['characteristics']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = Str::uuid().'.'.$file->extension();
            $file->storeAs('fishes', $name, 'public');
            $data['image'] = $name;
        }

        $fish->update($data);
        $typeWater = TypeWater::firstOrCreate(['type' => $request->input('type')]);

        if ($typeWater) {
            $fish->typeWater()->sync([$typeWater->id => $characteristics]);
        }

        Cache::forget('fishes');

        return new FishResource($fish->load('typeWater'));
    }

    /**
     * Delete a specific fish.
     *
     * @group Fishes V2
     *
     * @authenticated
     *
     * @urlParam fish int required The ID of the fish. Example: 1
     *
     * @response 200
     */
    public function destroy(Fish $fish): JsonResponse
    {
        $this->authorize('delete', $fish);

        $fish->delete();
        Cache::forget('fishes');

        return response()->json(['message' => __('Fish deleted successfully')], 200);
    }
}
