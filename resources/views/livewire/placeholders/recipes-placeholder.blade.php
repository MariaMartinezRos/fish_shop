{{--<div class="container mx-auto p-6">--}}
{{--    <h1 class="text-3xl font-bold text-center mb-6">{{ __('Recipes') }}</h1>--}}
{{--    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">--}}
@if($detailedMeals->isEmpty())
    <p class="text-center text-gray-500">{{ __('No recipes found.') }}</p>
    @else
        @foreach ($detailedMeals as $recipe)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-4">
                <img class="w-full h-48 object-cover rounded-md" src="{{ $recipe['strMealThumb'] }}" alt="{{ $recipe['strMeal'] }}" loading="lazy">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $recipe['strMeal'] }}</h2>
                    <p class="text-gray-600 text-sm mb-2">{{ __('Category') }}: {{ $recipe['strCategory'] }}</p>
                    <p class="text-gray-600 text-sm mb-2">{{ __('Area') }}: {{ $recipe['strArea'] }}</p>
                    <p class="text-gray-700 mt-2">{{ __('Instructions') }}:</p>
                    <p class="text-sm text-gray-600 truncate">{{ Str::limit($recipe['strInstructions'], 150, '...') }}</p>
                    <a href="{{ $recipe['strYoutube'] }}" target="_blank" class="text-blue-500 text-sm mt-2 inline-block">{{ __('Watch Video') }}</a>
                    <p class="text-gray-700 mt-2 font-semibold">{{ __('Ingredients') }}:</p>
                    <ul class="list-disc list-inside text-sm text-gray-600">
                        @for ($i = 1; $i <= 20; $i++)
                            @if (!empty($recipe['strIngredient' . $i]))
                                <li>{{ $recipe['strMeasure' . $i] }} {{ $recipe['strIngredient' . $i] }}</li>
                            @endif
                        @endfor
                    </ul>
                    <a href="{{ $recipe['strSource'] }}" target="_blank" class="block text-blue-600 mt-4 text-sm font-semibold">{{ __('View Full Recipe') }}</a>
                </div>
            </div>
        @endforeach
    @endif
{{--    </div>--}}
{{--</div>--}}
