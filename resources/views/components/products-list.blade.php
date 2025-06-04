@props(['products'])

<div class="bg-white">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Available products') }}</h2>

        <!-- Adjust grid for smaller items and tighter spacing -->
        <div class="mt-6 grid grid-cols-2 gap-x-2 gap-y-4 sm:grid-cols-3 md:grid-cols-5 xl:gap-x-4">
            @if( collect($products)->isEmpty())
                <p class="mt-6 text-center text-gray-500">{{ __('No products available.') }}</p>
            @else
            @foreach($products as $product)
                <div class="group relative bg-gray-100 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow flex justify-center items-center flex-col">
                    <!-- Imagen centrada -->
                    <img src="{{ $product['image'] }}" alt="{{ $product['alt'] }}" class="h-24 w-70 object-cover rounded-t-lg group-hover:opacity-75">

                    <div class="p-2 flex justify-between items-start m-auto m">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">

                                @if(Auth::check() && Auth::user()->role_id === 1)
                                    <a href="{{ route('products.show', $product['id']) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product['name'] }}
                                    </a>
                                @else
                                    <a href="{{ route('products.show-client', $product['id']) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product['name'] }}
                                    </a>
                                @endif
                            </h3>
                            <p class="mt-1 text-md text-gray-500">{{ $product['description'] }}</p>
                                <img src="{{ $product['category'] }}" alt="{{ __('Category of the fish') }}" class="h-6 w-6 ml-2">
                        </div>
                        <p class="text-lg font-medium text-gray-900">{{ $product['price'] }}</p>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
</div>

