<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
//    public function index()
//    {
//        $categories = DB::table('categories')->get();
//        return view('category', compact('categories'));
//    }
    public function index()
    {
        // Obtener todas las categorías
        $categories = DB::table('categories')->get();

        // Debug: verifica que hay datos
        if ($categories->isEmpty()) {
            // Si no hay datos, enviar mensaje o manejar esto según corresponda
            return view('category', ['categories' => []]);
        }

        return view('category', compact('categories'));
    }
}
