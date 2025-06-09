<?php


namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public string $search = '';

    /**
     * Muestra la lista de productos para el cliente
     */
    public function indexClient(Request $request)
    {

        $search = $request->input('search');

        $products = Product::search($search)->paginate(10);

        return view('dashboard.stock-client', compact('products'));
    }

    /**
     * Muestra un producto en particular al cliente
     */
    public function showClient($id)
    {

        $product = Product::findOrFail($id);

        return view('products.show-client', compact('product'));
    }
}
