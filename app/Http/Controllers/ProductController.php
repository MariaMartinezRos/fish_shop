<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Muestra la lista de productos.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');

        $products = Product::query()
            ->when($filter, function ($query, $filter) {
                return $query->where('name', 'like', '%' . $filter . '%')
                    ->orWhere('description', 'like', '%' . $filter . '%');
            })
            ->paginate(10);

        return view('stock', compact('products'));
//    public function index(Request $request)
//    {
//        $filter = $this->filter($request);
//
//        $products = Product::paginate(10); // 10 productos por página
//
//        if ($products->isEmpty()) {
//            return view('stock', ['products' => []]);
//        }
//
//        return view('stock', compact('products', 'filter'));
//    }
//
//    /**
//     * Filtra los productos por nombre, categoría y orden.
//     */
//    public function filter(Request $request)
//    {
//        $filter = $request->input('filter', '');
//        $category = $request->input('category', '');
//        $sort = $request->input('sort', '');
//
//        $query = Product::query();
//
//        if ($filter) {
//            $query->where('name', 'like', '%' . $filter . '%');
//        }
//
//        if ($category) {
//            $query->where('category_id', $category);
//        }
//
//        if ($sort) {
//            $query->orderBy('name', $sort);
//        }
//    }
    }
}
