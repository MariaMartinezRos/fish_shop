<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
//        $products = DB::table('products')->get();

        $products = Product::paginate(10); // 10 productos por página

        if ($products->isEmpty()) {
            return view('stock', ['products' => []]);
        }

        return view('stock', compact('products'));
    }
//    public function showStock()
//    {
//        $products = Product::paginate(10); // 10 productos por página
//        return view('stock', compact('products'));
//    }
}
