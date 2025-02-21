<?php

//
//namespace App\Http\Controllers;
//
//use App\Http\Requests\ProductRequest;
//use App\Imports\ProductsImport;
//use App\Models\Product;
//use Barryvdh\DomPDF\Facade\Pdf;
//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Http\Request;
//use Maatwebsite\Excel\Facades\Excel;
//
//class ProductController extends Controller
//{
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
//}





namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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

//        $products = Product::query()
//            ->when($filter, function ($query, $filter) {
//                return $query->where('name', 'like', '%'.$filter.'%')
//                    ->orWhere('description', 'like', '%'.$filter.'%');
//            })
//            ->paginate(10);

        $products = Product::search($search)->paginate(10);

//        $products = Product::search($this->search)->get();

//        $products = Product::query()->select('id', 'name', 'category_id', 'price_per_kg', 'stock_kg', 'description', 'created_at', 'updated_at')->paginate(10);
//        if ($request->ajax()) {
//            return view('components.product-list', compact('products'))->render();
//        }

        return view('stock', compact('products'));
    }

    /**
     * Muestra la lista de productos para el cliente
     */
    public function indexClient(Request $request)   //arreglar
    {
        $this->authorize('viewClient', User::class);

        $search = $request->input('search');
//
//        $products = Product::query()
//            ->when($filter, function ($query, $filter) {
//                return $query->where('name', 'like', '%'.$filter.'%')
//                    ->orWhere('description', 'like', '%'.$filter.'%');
//            })
//            ->paginate(10);
//
//        if ($request->ajax()) {
//            return view('components.product-list', compact('products'))->render();
//        }
//        $products = Product::query()->select('id', 'name', 'category_id', 'price_per_kg', 'stock_kg', 'description', 'created_at', 'updated_at')->paginate(10);

        $products = Product::search($this->$search)->paginate(10);

//        $products = Product::search($this->search)->get();
        return view('dashboard.stock-client', compact('products'));
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
     * Muestra un producto en particular al cliente
     */
    public function showClient($id)
    {
        $this->authorize('viewClient', User::class);

        $product = Product::findOrFail($id);

        return view('products.show-client', compact('product'));
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

        // No need for explicit validation, it's handled by ProductRequest
        $validated = $request->validated();

        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price_per_kg' => $validated['price_per_kg'],
            'stock_kg' => $validated['stock_kg'],
            'description' => $validated['description'],
        ]);

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

    /**
     * Descarga todos los productos en un archivo PDF
     */
    public function downloadProductsPDF()
    {
        $this->authorize('viewClient', User::class);

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
        $this->authorize('delete', Product::class);

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('products.index')->with('success', 'All products have been deleted.');
    }
}
