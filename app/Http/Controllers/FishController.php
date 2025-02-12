<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\FishesImport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FishController extends Controller
{
    use AuthorizesRequests;
    /**
     * Muestra la lista de productos. Tambien realiza una consulta en la base de datos para filtrarlos
     */
    public function index(Request $request)
    {
//        $this->authorize('view', Product::class);
//
//        $filter = $request->input('filter');
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

        return view('fish');
    }


    /**
     * Importa los productos desde un archivo Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new FishesImport, $request->file('file'));


        return redirect()->route('fish')->with('success', 'Fish list created successfully.');
    }

}
