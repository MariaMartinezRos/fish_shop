<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;


class PdfController extends Controller
{
    /**
     * Descarga todos los productos en un archivo PDF
     */

    public function generatePdf()
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml('<h1>PDF Content</h1>');
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return response()->streamDownload(function() use ($dompdf) {
            echo $dompdf->output();
        }, 'products.pdf');
    }
}
//    public function downloadProductsPDF()
//    {
//        $products = Product::all();
//
//        // Carga la vista y pasa los datos de los productos
//        $pdf = PDF::loadView('pdf.products', compact('products'));
//
//        // Descargar el archivo PDF con el nombre 'products.pdf'
//        return $pdf->download('products.pdf');
//    }

