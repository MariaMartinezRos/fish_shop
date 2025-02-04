<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CarrouselController extends Controller
{
    /**
     * Muestra la lista de categorías.
     */
    public function index()
    {
        $images = File::files(public_path('images/carrousel'));
        $imageUrls = array_map(fn($image) => asset('images/carrousel/' . $image->getFilename()), $images);
        return view('home', ['carrousel' => $imageUrls]);
    }
}
