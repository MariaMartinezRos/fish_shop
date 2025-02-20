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
    /**
     * @OA\Get (
     *     path="/fishes",
     *     tags={"Fishes"},
     *     summary="Get List all fishes",
     *
     *     @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Forbidden",
     *     )
     * )
     */
    public function index()
    {
        //abort_if(!auth()->user()->tokenCan('fishes-list'), 403);

        return FishResource::collection(Cache::rememberForever('fishes', function () {
            return Fish::all();
        }));
    }

    /**
     * @OA\Get (
     *     path="/fishes/{fish}",
     *     tags={"Fishes"},
     *     summary="Get a specific fish",
     *     description="Get a specific fish",
     *
     *     @OA\Parameter( name="fish", in="path", required=true, description="ID of the fish", @OA\Schema(type="integer")),
     *
     *     @OA\Response( response="200", description="Successful operation"),
     *     @OA\Response( response="401", description="Unauthenticated"),
     *     @OA\Response( response="403", description="Forbidden"),
     *     @OA\Response( response="404", description="Not Found")
     * )
     */
    public function show(Fish $fish)
    {
        //abort_if(!auth()->user()->tokenCan('fishes-show'), 403);

        return new FishResource($fish);
    }

    /**
     * Store a new fish
     *
     * Creating a new fish
     *
     * @bodyParam name string required The name of the fish. Example: Salmon
     * @bodyParam type string required The type of the fish. Example: Freshwater
     * @bodyParam price number required The price of the fish. Example: 10.5
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

        // Find the corresponding ID in the type_water table
        $typeWater = TypeWater::firstOrCreate(['type' => $request->input('type')]);


        if ($typeWater) {
            // Attach the type ID to the pivot table
            $fish->typeWater()->attach($typeWater->id);
        }
//        $fish->typeWater()->sync($request->input('type'));

        return new FishResource($fish);
    }

    /**
     * @return FishResource
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
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     *
     * @OA\Delete ( path="/fishes/{fish}", tags={"Fishes"}, summary="Delete a specific fish", description="Delete a specific fish", @OA\Parameter( name="fish", in="path", required=true, description="ID of the fish", @OA\Schema(type="integer")), @OA\Response( response="204", description="Successful operation"), @OA\Response( response="401", description="Unauthenticated"), @OA\Response( response="403", description="Forbidden"), @OA\Response( response="404", description="Not Found") )
     *
     * @ORM\Entity(repositoryClass=FishRepository::class)
     *
     * @ORM\Table(name="fish")
     */
    public function destroy(Fish $fish)
    {
        $fish->delete();

        return response()->noContent();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     * @OA\Get ( path="/fishes", tags={"Fishes"}, summary="List all fishes", description="List all fishes", @OA\Response( response="200", description="Successful operation"), @OA\Response( response="401", description="Unauthenticated"), @OA\Response( response="403", description="Forbidden") )
     *
     * @ORM\Entity(repositoryClass=FishRepository::class)
     *
     * @ORM\Table(name="fish")
     *
     * @ORM\Entity(repositoryClass=FishRepository::class)
     */
    public function list()
    {
        return FishResource::collection(Fish::all());
    }
}
