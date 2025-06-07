@include('partials.nav-bar-client')

@php
    $detailedMeals = collect($detailedMeals);
@endphp
<div class="container mx-auto p-6">
<h1 class="text-3xl font-bold text-center mb-6">{{ __('Recipes') }}</h1>
@if(session()->has('error') || $detailedMeals->isEmpty())
    <div class="flex flex-col items-center justify-center mt-6 space-y-4">
        @if(session()->has('error') && str_contains(session('error'), 'cURL error 6'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative max-w-2xl w-full text-center" role="alert">
                <span class="block sm:inline">{{ __('Unable to connect to the recipe database. Please try again later.') }}</span>
            </div>
        @endif

        @if($detailedMeals->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative max-w-2xl w-full text-center" role="alert">
                <span class="block sm:inline">{{ __('No recipes available.') }}</span>
            </div>
        @endif
    </div>
@endif

    @if(!$detailedMeals->isEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
        </div>
    @endif
</div>

@include('partials.footer')
