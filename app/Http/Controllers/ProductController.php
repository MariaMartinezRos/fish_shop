<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Muestra la lista de productos. Tambien realiza una consulta en la base de datos para filtrarlos
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');

        $products = Product::query()
            ->when($filter, function ($query, $filter) {
                return $query->where('name', 'like', '%'.$filter.'%')
                    ->orWhere('description', 'like', '%'.$filter.'%');
            })
            ->paginate(10);

        if ($request->ajax()) {
            return view('components.product-list', compact('products'))->render();
        }

        return view('stock', compact('products'));
    }
}
