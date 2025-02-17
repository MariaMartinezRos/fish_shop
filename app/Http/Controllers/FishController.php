<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\FishesImport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;


class FishController extends Controller
{
    use AuthorizesRequests;

    /**
     * Shows the fishes list for the admin
     * @throws ConnectionException
     */
    public function index(Request $request)
    {
        $fishes = $this->getFishes();

        // Devuelve la vista con los datos de los peces
        return view('fish', compact('fishes'));
    }

    /**
     * Shows the fishes list for the client
     * @throws ConnectionException
     */
    public function indexClient(Request $request)
    {
        $fishes = $this->getFishes();

        // Devuelve la vista con los datos de los peces
        return view('dashboard.discover', compact('fishes'));
    }

    private function getFishes()
    {
        $token = env('BEARER_TOKEN');

        // Hacer la solicitud GET a la API para obtener todos los peces
        $response = Http::withToken($token)
            ->get('http://fish_shop.test/api/v2/fishes');


        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            $fishes = $response->json(); // Decodifica la respuesta JSON
        } else {
            $fishes = []; // Si no hay éxito, pasa un array vacío
        }

        return $fishes;
    }
    /**
     * Import the products from the file excel
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
