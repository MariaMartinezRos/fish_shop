<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    /**
     * Shows the categories page.
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
