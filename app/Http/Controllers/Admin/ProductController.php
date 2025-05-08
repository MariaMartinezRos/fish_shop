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

namespace App\Http\Controllers\Admin;

use App\Events\ProductAdded;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public string $search = '';

    /**
     * Muestra la lista de productos. Tambien realiza una consulta en la base de datos para filtrarlos
     */
    public function index(Request $request)
    {
        $this->authorize('view', User::class);

        $search = $request->input('search');

        $products = Product::search($search)->paginate(10);

        return view('stock', compact('products'));
    }

    /**
     * Muestra un producto en particular
     */
    public function show($id)
    {
        $this->authorize('view', User::class);

        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Importa los productos desde un archivo Excel
     */
    public function import(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()->route('stock')->with('success', 'Product created successfully.');

    }

    /**
     * Agrega un producto
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $product = Product::create($validated);

        event(new ProductAdded($product));


        // Redirigir con mensaje de éxito
        return redirect()->route('products.show', ['id' => $product->id])->with('success', 'Product created successfully.');
    }

    /**
     * Edita un producto
     */
    public function edit(Product $product)
    {
        $this->authorize('update', User::class);

        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', User::class);

        $validated = $request->validated();

        $product->update($validated);

        return redirect()->route('products.show', ['id' => $product->id])->with('success', 'Product updated successfully');
    }

    /**
     * Elimina un producto
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', User::class);

        $product->delete();

        return redirect()->route('stock')->with('success', 'Product deleted successfully');
    }

    // DANGER ZONE
    /**
     * Elimina todos los productos
     */
    public function deleteAll()
    {
        $this->authorize('delete', Product::class);

        // desactiva temporalmente las restricciones de claves foráneas en la base de datos

        //esto es necesario ya qeu si la tabla products tiene una relación con otra tabla
        // (como categories), no se puede eliminar o truncar la tabla products si hay registros
        // en categorias que dependan de ella
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('products.index')->with('success', 'All products have been deleted.');
    }
}
