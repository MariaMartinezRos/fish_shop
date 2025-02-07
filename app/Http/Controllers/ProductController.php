<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    /**
     * Muestra la lista de productos para el cliente
     */
    public function indexClient(Request $request)
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

        return view('dashboard.stock-client', compact('products'));
    }

    /**
     * Muestra un producto en particular
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Exporta los productos a un archivo Excel
     */
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
     * Importa los productos desde un archivo Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        //        Excel::import(new ProductsImport, 'products.xlsx');

        return redirect('/')->with('success', 'All good!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price_per_kg' => 'required|numeric',
            'stock_kg' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->price_per_kg = $request->input('price_per_kg');
        $product->stock_kg = $request->input('stock_kg');
        $product->description = $request->input('description');
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    //DANGER ZONE
    /**
     * Elimina todos los productos
     */
    public function deleteAll()
    {
        //show a wizard to confirm that you want to delete all products
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('products.index')->with('success', 'All products have been deleted.');
    }
}
