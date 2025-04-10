

<div class="py-12 flex justify-center">
    <div class="max-w-6xl w-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center">
        <!-- Imagen del producto -->
        <img class="rounded object-cover" style="width: 400px; height: 300px;"
             src="{{ file_exists(public_path('images/'.$product->name.'.png')) ? asset('images/'.$product->name.'.png') : asset('images/default.png') }}"
             alt="{{ $product['name'] }}">

        <!-- Contenedor derecho más a la derecha y centrado -->
        <div class="ml-12 flex-1 text-center">
            <!-- Nombre centrado y grande -->
            <div class="flex items-center justify-center">
                <h1 class="text-4xl font-bold">{{ $product['name'] }}</h1>
                <img src="{{ asset('images/'.$product['category_id'].'.png') }}" alt="{{ __('Category of the fish') }}"
                     class="h-6 w-6 ml-2"
                     onerror="this.onerror=null; this.src='{{ asset('images/0.png') }}';">
            </div>

            <!-- Información del producto -->
            <p class="text-gray-600 mt-4 text-lg">{{ $product['description'] }}</p>
            <p class="text-2xl font-bold text-green-600 mt-4">{{ $product['price_per_kg'] }} €/kg</p>
            <p class="text-gray-600 mt-4 text-lg">{{ __('Amount: ').$product['stock_kg'] }} kg</p>

            <!-- Botones de acción -->
            <div class="mt-6 flex justify-center space-x-4">
                @if(Auth::check() && Auth::user()->role_id === 1)
                    <a href="{{ route('products.edit', $product) }}" class="text-blue-600 dark:text-blue-400">{{ __('Edit') }}</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 dark:text-red-400 ml-2">{{ __('Delete') }}</button>
                    </form>
                @endif
            </div>
        </div>

    </div>
</div>
