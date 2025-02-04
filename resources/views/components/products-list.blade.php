@props(['products'])

<div class="bg-white">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Available products') }}</h2>

        <!-- Adjust grid for smaller items and tighter spacing -->
        <div class="mt-6 grid grid-cols-2 gap-x-2 gap-y-4 sm:grid-cols-3 md:grid-cols-5 xl:gap-x-4">
            @foreach($products as $product)
                <div class="group relative bg-gray-100 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow flex justify-center items-center flex-col">
                    <!-- Imagen centrada -->
                    <img src="{{ $product['image'] }}" alt="{{ $product['alt'] }}" class="h-24 w-70 object-cover rounded-t-lg group-hover:opacity-75">

                    <div class="p-2 flex justify-between items-start m-auto m">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700">
                                <a href="{{ route('products.show', $product['id']) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product['name'] }}
                                </a>
                            </h3>
                            <p class="mt-1 text-md text-gray-500">{{ $product['description'] }}</p>
{{--                            <p class="mt-1 text-md text-gray-500">{{ $product['category'] }}</p>--}}
                            <a href="{{ route('categories.show', $product['category'])}}">
                                <img src="{{ $product['category'] }}" alt="Category of the fish" class="h-6 w-6 ml-2">
                            </a>
                        </div>
                        <p class="text-lg font-medium text-gray-900">{{ $product['price'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


{{--@props(['products'])--}}

{{--<div class="bg-white">--}}
{{--    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">--}}
{{--        <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Available products') }}</h2>--}}

{{--        <!-- Adjust grid for smaller items and tighter spacing -->--}}
{{--        <div class="mt-6 grid grid-cols-2 gap-x-2 gap-y-4 sm:grid-cols-3 md:grid-cols-5 xl:gap-x-4">--}}
{{--            @foreach($products as $product)--}}
{{--                <div class="group relative bg-gray-100 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">--}}
{{--                    <!-- Set a smaller fixed height for the images -->--}}
{{--                    <img src="{{ $product['image'] }}" alt="{{ $product['alt'] }}" class="h-36 w-full object-cover rounded-t-lg group-hover:opacity-75">--}}

{{--                    <div class="p-2 flex justify-between items-start">--}}
{{--                        <div>--}}
{{--                            <h3 class="text-xs font-semibold text-gray-700">--}}
{{--                                <a href="#">--}}
{{--                                    <span aria-hidden="true" class="absolute inset-0"></span>--}}
{{--                                    {{ $product['name'] }}--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="mt-1 text-xs text-gray-500">{{ $product['description'] }}</p>--}}
{{--                        </div>--}}
{{--                        <p class="text-sm font-medium text-gray-900">{{ $product['price'] }}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}





{{--@props(['products'])--}}

{{--<div class="bg-white">--}}
{{--    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">--}}
{{--        <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Available products') }}</h2>--}}

{{--        <!-- Adjust the grid to 4 columns on larger screens -->--}}
{{--        <div class="mt-6 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 md:grid-cols-4 xl:gap-x-6">--}}
{{--            @foreach($products as $product)--}}
{{--                <div class="group relative bg-gray-100 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">--}}
{{--                    <!-- Set a fixed height for the images -->--}}
{{--                    <img src="{{ $product['image'] }}" alt="{{ $product['alt'] }}" class="h-48 w-full object-cover rounded-t-lg group-hover:opacity-75">--}}

{{--                    <div class="p-4 flex justify-between items-start">--}}
{{--                        <div>--}}
{{--                            <h3 class="text-sm font-semibold text-gray-700">--}}
{{--                                <a href="#">--}}
{{--                                    <span aria-hidden="true" class="absolute inset-0"></span>--}}
{{--                                    {{ $product['name'] }}--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="mt-1 text-xs text-gray-500">{{ $product['description'] }}</p>--}}
{{--                        </div>--}}
{{--                        <p class="text-sm font-medium text-gray-900">{{ $product['price'] }}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}





{{--@props(['products'])--}}

{{--<div class="bg-white">--}}
{{--    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">--}}
{{--        <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ __('Available products') }}</h2>--}}

{{--        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">--}}
{{--            @foreach($products as $product)--}}
{{--                <div class="group relative">--}}
{{--                    <img src="{{ $product['image'] }}" alt="{{ $product['alt'] }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">--}}
{{--                    <div class="mt-4 flex justify-between">--}}
{{--                        <div>--}}
{{--                            <h3 class="text-sm text-gray-700">--}}
{{--                                <a href="#">--}}
{{--                                    <span aria-hidden="true" class="absolute inset-0"></span>--}}
{{--                                    {{ $product['name'] }}--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="mt-1 text-sm text-gray-500">{{ $product['description'] }}</p>--}}
{{--                        </div>--}}
{{--                        <p class="text-sm font-medium text-gray-900">{{ $product['price'] }}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--@props(['metaProduct'])--}}

{{--<div class="bg-white">--}}
{{--    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">--}}
{{--        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>--}}

{{--        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">--}}
{{--            <div class="group relative">--}}
{{--                <img src="{{ $metaProduct['image'] }}" alt="{{ $metaProduct['alt'] }}" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">--}}
{{--                <div class="mt-4 flex justify-between">--}}
{{--                    <div>--}}
{{--                        <h3 class="text-sm text-gray-700">--}}
{{--                            <a href="#">--}}
{{--                                <span aria-hidden="true" class="absolute inset-0"></span>--}}
{{--                                {{ $metaProduct['name'] }}--}}
{{--                            </a>--}}
{{--                        </h3>--}}
{{--                        <p class="mt-1 text-sm text-gray-500">{{ $metaProduct['description'] }}</p>--}}
{{--                    </div>--}}
{{--                    <p class="text-sm font-medium text-gray-900">{{ $metaProduct['price'] }}</p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- More products... -->--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
