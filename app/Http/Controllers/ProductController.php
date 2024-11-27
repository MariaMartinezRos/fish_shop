<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
//        $products = DB::table('products')->get();

        $filter = $this->filter($request);

        $products = Product::paginate(10); // 10 productos por página

        if ($products->isEmpty()) {
            return view('stock', ['products' => []]);
        }

        return view('stock', compact('products', 'filter'));
    }
    public function filter(Request $request)
    {
        $filter = $request->input('filter', '');
        $category = $request->input('category', '');
        $sort = $request->input('sort', '');

        $query = Product::query();

        if ($filter) {
            $query->where('name', 'like', '%' . $filter . '%');
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($sort) {
            $query->orderBy('name', $sort);
        }
    }
}
