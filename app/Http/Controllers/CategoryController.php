<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    /**
     * Muestra la lista de categorías.
     */
    public function index()
    {
        $this->authorize('view', Category::class);

        // Consulta en la base de datos para obtener todas las categorías
        $categories = DB::table('categories')->get();

        if ($categories->isEmpty()) {
            return view('category', ['categories' => []]);
        }

        return view('category', compact('categories'));
    }
}
