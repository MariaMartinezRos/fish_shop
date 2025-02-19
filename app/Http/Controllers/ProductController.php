<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use AuthorizesRequests;
    /**
     * Muestra la lista de productos. Tambien realiza una consulta en la base de datos para filtrarlos
     */
    public function index(Request $request)
    {
//        $this->authorize('view', Product::class);

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
    public function indexClient(Request $request)   //arreglar
    {
//        $this->authorize('viewClient', Product::class);

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
//        $this->authorize('view', Product::class);

        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }
    /**
     * Muestra un producto en particular al cliente
     */
    public function showClient($id)
    {
//        $this->authorize('viewClient', Product::class);

        $product = Product::findOrFail($id);

        return view('products.show-client', compact('product'));
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

//        return redirect('/')->with('success', 'All good!');
        return redirect()->route('stock')->with('success', 'Product created successfully.');

    }

    /**
     * Agrega un producto
     */


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'category_id' => 'required|integer|exists:categories,id',
            'price_per_kg' => 'required|numeric',
            'stock_kg' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        // Crear el producto (venta)
        $product = new Product;
        $product->name = $validated['name'];
        $product->category_id = $validated['category_id'];
        $product->price_per_kg = $validated['price_per_kg'];
        $product->stock_kg = $validated['stock_kg'];
        $product->description = $validated['description'];

        // Guardar en base de datos
        $product->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('products.show', ['id' => $product->id])->with('success', 'Product created successfully.');
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price_per_kg' => 'required|numeric',
            'stock_kg' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price_per_kg' => $validated['price_per_kg'],
            'stock_kg' => $validated['stock_kg'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('products.show', ['id' => $product->id])->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('stock')->with('success', 'Product deleted successfully');
    }


//    public function add(Request $request)
//    {
//
////        $this->authorize('create', Product::class);
//
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'category_id' => 'required|integer|exists:categories,id',
//            'price_per_kg' => 'required|numeric',
//            'stock_kg' => 'required|numeric',
//            'description' => 'nullable|string',
//        ]);
//
//        $product = new Product;
//        $product->name = $request->input('name');
//        $product->category_id = $request->input('category_id' );
//        $product->price_per_kg = $request->input('price_per_kg');
//        $product->stock_kg = $request->input('stock_kg');
//        $product->description = $request->input('description');
//        $product->save();
//        return redirect()->route('stock')->with('success', 'Product created successfully.');
//    }

//     Método para descargar el PDF con todos los productos
    public function downloadProductsPDF()
    {
        // Obtener todos los productos de la base de datos
        $products = Product::all();

        // Generar el PDF usando la vista y pasando los productos
        $pdf = PDF::loadView('pdf.products', compact('products'));

        // Set page numbers in the footer
        $pdf->setOption('footer-right', 'Page {PAGE_NUM} of {PAGE_COUNT}');
        $pdf->setOption('footer-font-size', 10);

        // Descargar el PDF
        return $pdf->download('products.pdf');
    }

    //DANGER ZONE
    /**
     * Elimina todos los productos
     */
    public function deleteAll()
    {
//        $this->authorize('delete', Product::class);

        //show a wizard to confirm that you want to delete all products
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('products.index')->with('success', 'All products have been deleted.');
    }
}
