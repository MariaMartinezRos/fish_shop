<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Muestra la lista de categorías.
     */
    public function index()
    {
        $categories = DB::table('categories')->get();

        if ($categories->isEmpty()) {
            return view('category', ['categories' => []]);
        }

        return view('category', compact('categories'));
    }
}
