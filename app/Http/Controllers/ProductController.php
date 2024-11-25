<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();

        if ($products->isEmpty()) {
            return view('stock', ['products' => []]);
        }

        return view('stock', compact('products'));
    }
}
