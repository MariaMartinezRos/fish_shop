<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFishRequest;
use App\Http\Resources\FishResource;
use App\Models\Fish;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        abort_if(!auth()->user()->tokenCan('fishes-list'), 403);

        return FishResource::collection(Cache::rememberForever('fishes', function () {
            return Fish::all();
        }));
    }

    public function show(Fish $fish)
    {
        abort_if(!auth()->user()->tokenCan('fishes-show'), 403);

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
            $name = Str::uuid() . '.' . $file->extension();
            $file->storeAs('fishes', $name, 'public');
            $data['photo'] = $name;
        }

        $fish = Fish::create($data);

        return new FishResource($fish);
    }

    public function update(Fish $fish, StoreFishRequest $request)
    {
        $fish->update($request->all());

        return new FishResource($fish);
    }

    public function destroy(Fish $fish)
    {
        $fish->delete();

        return response()->noContent();
    }

    public function list()
    {
        return FishResource::collection(Fish::all());
    }

    public function filterByType($type)
    {
        $fishes = Fish::where('type', $type)->get();
        return FishResource::collection($fishes);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $fishes = Fish::where('name', 'LIKE', "%$query%")
            ->orWhere('type', 'LIKE', "%$query%")
            ->get();
        return FishResource::collection($fishes);
    }
}

