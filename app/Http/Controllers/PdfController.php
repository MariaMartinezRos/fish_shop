<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Policies\PdfPolicy;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PdfController extends Controller
{
    use AuthorizesRequests;

    /**
     * Descarga todos los productos en un archivo PDF
     */
    public function generatePdf()
    {
        $products = Product::all();

        // Carga la vista y pasa los datos de los productos
        $pdf = PDF::loadView('pdf.products', compact('products'));

        // Descargar el archivo PDF con el nombre 'products.pdf'
        return $pdf->download('products.pdf');
    }
}
