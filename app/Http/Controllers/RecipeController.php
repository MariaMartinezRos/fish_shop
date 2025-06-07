<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    /**
     * Muestra las recetas disponibles
     */

    public function showRecipes()
    {
        try {
            $detailedMeals = Cache::rememberForever('seafood_detailed_meals', function () {
                $response = Http::get('https://www.themealdb.com/api/json/v1/1/filter.php?c=Seafood');

                if (!$response->ok()) {
                    throw new \Exception('No recipes found.');
                }

                $meals = $response->json()['meals'] ?? [];
                $mealIds = array_column($meals, 'idMeal');

                $responses = Http::pool(fn($pool) => [
                    ...array_map(fn($id) => $pool->get("https://www.themealdb.com/api/json/v1/1/lookup.php?i={$id}"), $mealIds),
                ]);

                return collect($responses)
                    ->filter(fn($res) => $res->ok())
                    ->map(fn($res) => $res->json()['meals'][0])
                    ->all();
            });

            return view('dashboard.recipes', compact('detailedMeals'));

        } catch (ConnectionException $e) {
            session()->flash('error', $e->getMessage());
            return view('dashboard.recipes', ['detailedMeals' => collect([])]);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return view('dashboard.recipes', ['detailedMeals' => collect([])]);
        }
    }
}
//    public function showRecipes()
//    {
//        $detailedMeals = Cache::rememberForever('seafood_detailed_meals', function () {
//            $response = Http::get('https://www.themealdb.com/api/json/v1/1/filter.php?c=Seafood');
//
//            if (!$response->ok()) {
//                session()->flash('error', __('No recipes found.'));
//                return redirect()->back();
//            }
//
//            $meals = $response->json()['meals'] ?? [];
//            $mealIds = array_column($meals, 'idMeal');
//
//            // hacer varias llamadas en paralelo
//            $responses = Http::pool(fn ($pool) => [
//                ...array_map(fn ($id) =>
//                $pool->get("https://www.themealdb.com/api/json/v1/1/lookup.php?i={$id}"), $mealIds),
//            ]);
//
//            return collect($responses)
//                ->filter(fn ($res) => $res->ok())
//                ->map(fn ($res) => $res->json()['meals'][0])
//                ->all();
//        });
//
//        return view('dashboard.recipes', compact('detailedMeals'));
//    }
//    public function showRecipes()
//    {
//        $response = Http::get('www.themealdb.com/api/json/v1/1/filter.php?c=Seafood');
//        $recipes = $response->json();
//
//        // Convertir la respuesta en un array y extraer los valores de idMeal
//        $meals = $recipes['meals'];
//        $mealIds = array_map(function ($meal) {
//            return $meal['idMeal'];
//        }, $meals);
//
//        // Array to hold detailed meal information
//        $detailedMeals = [];
//
//        // Loop through each idMeal and make a request to the lookup API
//        // indexar las respuestas de la llamada a la api
//        foreach ($mealIds as $idMeal) {
//            $response2 = Http::get("www.themealdb.com/api/json/v1/1/lookup.php?i={$idMeal}");
//            $mealDetails = $response2->json();
//            $detailedMeals[] = $mealDetails['meals'][0];
//        }
//
//        return view('dashboard.recipes', compact('detailedMeals'));
//    }

