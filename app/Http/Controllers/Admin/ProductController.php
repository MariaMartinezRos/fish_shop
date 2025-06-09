<?php

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
     * Shows the list of products. Also performs a database query to filter them
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $search = $request->input('search');

        $products = Product::search($search)->paginate(10);

        return view('stock', compact('products'));
    }

    /**
     * Shows a particular product
     */
    public function show($id)
    {
        $this->authorize('view', User::class);

        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Imports products from an Excel file
     */
    public function import(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()->route('stock')->with('success', __('Product created successfully.'));
    }

    /**
     * Adds a product
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

        // Redirect with success message
        return redirect()->route('products.show', ['id' => $product->id])->with('success', __('Product created successfully.'));
    }

    /**
     * Edits a product
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

        return redirect()->route('products.show', ['id' => $product->id])->with('success', __('Product updated successfully'));
    }

    /**
     * Deletes a product
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', User::class);

        $product->delete();

        return redirect()->route('stock')->with('success', __('Product deleted successfully'));
    }

    // DANGER ZONE
    /**
     * Deletes all products
     */
    public function deleteAll()
    {
        $this->authorize('delete', Product::class);

        // Temporarily disable foreign key constraints in the database
        // This is necessary because if the products table has a relationship with another table
        // (like categories), you cannot delete or truncate the products table if there are records
        // in categories that depend on it
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->route('products.index')->with('success', __('All products have been deleted.'));
    }
}
