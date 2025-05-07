<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
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
//        $this->authorize('view', User::class);

        $categories = DB::table('categories')->get();

        if ($categories->isEmpty()) {
            return view('category', ['categories' => []]);
        }

        return view('category', compact('categories'));
    }
}
