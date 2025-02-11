<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fish;
use Illuminate\Http\Request;

class FishController extends Controller
{
    // Obtener todos los pescados con su tipo de agua
    public function index()
    {
        $fishes = Fish::with('typeWater')->get();
        return response()->json($fishes);
    }

    // Obtener un pescado por ID
    public function show($id)
    {
        $fish = Fish::with('typeWater')->findOrFail($id);
        return response()->json($fish);
    }

    // Crear un nuevo pescado
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'type_water' => 'required|array', ///////////////////////////////
        ]);

        $fish = Fish::create($request->only('name', 'image', 'description'));

        // Asociar los tipos de agua
        $fish->TypeWater()->attach($request->type_water);

        return response()->json($fish, 201);
    }

    // Actualizar un pescado
    public function update(Request $request, $id)
    {
        $fish = Fish::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'type_water' => 'required|array',
        ]);

        $fish->update($request->only('name', 'image', 'description'));

        // Actualizar tipos de agua
        $fish->TypeWater()->sync($request->type_water);

        return response()->json($fish);
    }

    // Eliminar un pescado
    public function destroy($id)
    {
        $fish = Fish::findOrFail($id);
        $fish->TypeWater()->detach(); // Eliminar relaciones
        $fish->delete();

        return response()->json(null, 204);
    }
}

