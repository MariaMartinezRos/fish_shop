<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    /**
     * Muestra las recetas disponibles
     */
    public function showRecipes()
    {
        try {
            $detailedMeals = Cache::rememberForever('seafood_detailed_meals', function () {
                $response = Http::get('https://www.themealdb.com/api/json/v1/1/filter.php?c=Seafood');

                if (! $response->ok()) {
                    session()->flash('error');

                    return view('dashboard.recipes', ['detailedMeals' => collect([])]);
                }

                $meals = $response->json()['meals'] ?? [];
                $mealIds = array_column($meals, 'idMeal');

                $responses = Http::pool(fn ($pool) => [
                    ...array_map(fn ($id) => $pool->get("https://www.themealdb.com/api/json/v1/1/lookup.php?i={$id}"), $mealIds),
                ]);

                return collect($responses)
                    ->filter(fn ($res) => $res->ok())
                    ->map(fn ($res) => $res->json()['meals'][0])
                    ->all();
            });

            return view('dashboard.recipes', compact('detailedMeals'));

        } catch (ConnectionException|\Exception $e) {
            session()->flash('error', $e->getMessage());

            return view('dashboard.recipes', ['detailedMeals' => collect([])]);
        }
    }
}
