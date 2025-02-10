<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    /**
     * Muestra las recetas disponibles
     */
    public function showRecipes()
    {
        $response = Http::get('www.themealdb.com/api/json/v1/1/filter.php?c=Seafood');
        $recipes = $response->json();

        // Convertir la respuesta en un array y extraer los valores de idMeal
        $meals = $recipes['meals'];
        $mealIds = array_map(function($meal) {
            return $meal['idMeal'];
        }, $meals);

        // Array to hold detailed meal information
        $detailedMeals = [];

        // Loop through each idMeal and make a request to the lookup API
        foreach ($mealIds as $idMeal) {
            $response2 = Http::get("www.themealdb.com/api/json/v1/1/lookup.php?i={$idMeal}");
            $mealDetails = $response2->json();
            $detailedMeals[] = $mealDetails['meals'][0];
        };

//        dd($detailedMeals);

        return view('dashboard.recipes', compact('detailedMeals'));
    }
}
