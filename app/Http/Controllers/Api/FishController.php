<?php


namespace App\Http\Controllers\Api;

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


//namespace App\Http\Controllers\Api;
//
//use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
//use App\Models\Fish;
//use Illuminate\Http\Response;
//
//class FishController extends Controller
//{
//    public function index()
//    {
//        return response()->json(Fish::all(), Response::HTTP_OK);
//    }
//
//    public function show(Fish $fish)
//    {
//        return response()->json($fish, Response::HTTP_OK);
//    }
//
//    public function store(Request $request)
//    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'type' => 'required|string|max:255',
//            'price' => 'required|numeric|min:0',
//        ]);
//
//        $fish = Fish::create($request->all());
//        return response()->json($fish, Response::HTTP_CREATED);
//    }
//
//    public function update(Request $request, Fish $fish)
//    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'type' => 'required|string|max:255',
//            'price' => 'required|numeric|min:0',
//        ]);
//
//        $fish->update($request->all());
//        return response()->json($fish, Response::HTTP_OK);
//    }
//
//    public function destroy(Fish $fish)
//    {
//        $fish->delete();
//        return response()->json(['message' => 'Fish deleted successfully'], Response::HTTP_NO_CONTENT);
//    }
//
//    public function filterByType($type)
//    {
//        $fishes = Fish::where('type', $type)->get();
//        return response()->json($fishes, Response::HTTP_OK);
//    }
//
//    public function search(Request $request)
//    {
//        $query = $request->input('query');
//        $fishes = Fish::where('name', 'LIKE', "%$query%")
//            ->orWhere('type', 'LIKE', "%$query%")
//            ->get();
//        return response()->json($fishes, Response::HTTP_OK);
//    }
//}


//namespace App\Http\Controllers\Api;
//
//use App\Http\Controllers\Controller;
//use App\Imports\FishesImport;
//use App\Models\Fish;
//use Illuminate\Http\Request;
//use Maatwebsite\Excel\Facades\Excel;
//
//class FishController extends Controller
//{
//    // Obtener todos los pescados con su tipo de agua
//    public function index()
//    {
//        $fishes = Fish::with('typeWater')->get();
//        return response()->json($fishes);
//    }
//
//    // Obtener un pescado por ID
//    public function show($id)
//    {
//        $fish = Fish::with('typeWater')->findOrFail($id);
//        return response()->json($fish);
//    }
//
//    // Crear un nuevo pescado
//    public function store(Request $request)
//    {
//        $request->validate([
//            'name' => 'required',
//            'image' => 'nullable|string',
//            'description' => 'nullable|string',
//            'type_water' => 'required|array', ///////////////////////////////
//        ]);
//
//        $fish = Fish::create($request->only('name', 'image', 'description'));
//
//        // Asociar los tipos de agua
//        $fish->TypeWater()->attach($request->type_water);
//
//        return response()->json($fish, 201);
//    }
//
//    // Actualizar un pescado
//    public function update(Request $request, $id)
//    {
//        $fish = Fish::findOrFail($id);
//
//        $request->validate([
//            'name' => 'required',
//            'image' => 'nullable|string',
//            'description' => 'nullable|string',
//            'type_water' => 'required|array',
//        ]);
//
//        $fish->update($request->only('name', 'image', 'description'));
//
//        // Actualizar tipos de agua
//        $fish->TypeWater()->sync($request->type_water);
//
//        return response()->json($fish);
//    }
//
//    /**
//     * Importa los productos desde un archivo Excel
//     */
//    public function import(Request $request)
//    {
//        $request->validate([
//            'file' => 'required|mimes:xlsx',
//        ]);
//
//        Excel::import(new FishesImport, $request->file('file'));
//
//
//        return redirect()->route('fish')->with('success', 'Fish list created successfully.');
//    }
//
//    // Eliminar un pescado
//    public function destroy($id)
//    {
//        $fish = Fish::findOrFail($id);
//        $fish->TypeWater()->detach(); // Eliminar relaciones
//        $fish->delete();
//
//        return response()->json(null, 204);
//    }
//}

