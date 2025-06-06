<?php

//
// namespace App\Http\Controllers;
//
// use App\Http\Requests\ProductRequest;
// use App\Imports\ProductsImport;
// use App\Models\Product;
// use Barryvdh\DomPDF\Facade\Pdf;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;
//
// class ProductController extends Controller
// {
//    use AuthorizesRequests;
//
//    /**
//     * Shows the list of products. Also performs a database query to filter them. (for the admin)
//     */
//    public function index(Request $request)
//    {
//        $filter = $request->input('filter');
//
//        $products = Product::query()
//            ->when($filter, fn($query, $filter) => $query->where('name', 'like', "%$filter%")
//                ->orWhere('description', 'like', "%$filter%"))
//            ->paginate(10);
//
//        if ($request->ajax()) {
//            return view('components.product-list', compact('products'))->render();
//        }
//
//        return view('stock', compact('products'));
//    }
//
//    /**
//     * Shows the list of products. Also performs a database query to filter them. (for the client)
//     */
//    public function indexClient(Request $request)
//    {
//        $filter = $request->input('filter');
//
//        $products = Product::query()
//            ->when($filter, fn($query, $filter) => $query->where('name', 'like', "%$filter%")
//                ->orWhere('description', 'like', "%$filter%"))
//            ->paginate(10);
//
//        if ($request->ajax()) {
//            return view('components.product-list', compact('products'))->render();
//        }
//
//        return view('dashboard.stock-client', compact('products'));
//    }
//
//    /**
//     * Shows a particular product. (for the admin)
//     * @param Product $product
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
//     */
//    public function show(Product $product)
//    {
//        return view('products.show', compact('product'));
//    }
//
//    /**
//     * Shows a particular product. (for the client)
//     * @param Product $product
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
//     */
//    public function showClient(Product $product)
//    {
//        return view('products.show-client', compact('product'));
//    }
//
//    /**
//     * Imports products from an Excel file.
//     */
//    public function import(Request $request)
//    {
//        $request->validate(['file' => 'required|mimes:xlsx']);
//        Excel::import(new ProductsImport, $request->file('file'));
//        return redirect()->route('stock')->with('success', 'Producto importado correctamente.');
//    }
//
//    /**
//     * Downloads all products in a PDF file.
//     */
//    public function downloadProductsPDF()
//    {
//        $products = Product::all();
//        $pdf = PDF::loadView('pdf.products', compact('products'));
//        return $pdf->download('productos.pdf');
//    }
//
//    /**
//     * Adds a product.
//     */
//    public function create()
//    {
//        return view('products.create');
//    }
//
//    /**
//     * Stores a product.
//     */
//    public function store(ProductRequest $request)
//    {
//        $product = Product::create($request->validated());
//        return redirect()->route('products.show', $product)->with('success', 'Producto creado correctamente.');
//    }
//
//    /**
//     * Edits a product.
//     */
//    public function edit(Product $product)
//    {
//        return view('products.edit', compact('product'));
//    }
//
//    /**
//     * Updates a product.
//     */
//    public function update(ProductRequest $request, Product $product)
//    {
//        $product->update($request->validated());
//        return redirect()->route('products.show', $product)->with('success', 'Producto actualizado correctamente.');
//    }
//
//    /**
//     * Deletes a product.
//     */
//    public function destroy(Product $product)
//    {
//        $product->delete();
//        return redirect()->route('stock')->with('success', 'Producto eliminado correctamente.');
//    }
//
//    /**
//     * Deletes all products.
//     */
//    public function deleteAll()
//    {
//        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        Product::truncate();
//        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
//        return redirect()->route('products.index')->with('success', 'Todos los productos han sido eliminados.');
//    }
// }

namespace App\Http\Controllers;

use App\Models\Product;
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
