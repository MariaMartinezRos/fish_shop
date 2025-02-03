<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stock') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <input type="text" id="filter" placeholder="Filter products">

                    <div id="product-list">
                        @include('components.product-list', ['products' => $products])
                    </div>
{{--                    <form method="GET" action="{{ route('products.index') }}">--}}
{{--                        <input type="text" name="filter" value="{{ request('filter') }}" placeholder="Filter products">--}}
{{--                        <button type="submit">Filter</button>--}}
{{--                    </form>--}}

{{--                    @if(isset($products) && count($products) > 0)--}}
{{--                        @php--}}
{{--                            $productList = [];--}}
{{--                            foreach($products as $product) {--}}
{{--                                $imagePath = 'images/'.$product->name.'.png';--}}
{{--                                $productList[] = [--}}
{{--                                    'image' => file_exists(public_path($imagePath)) ? asset($imagePath) : asset('images/default.png'),--}}
{{--                                    'alt' => $product->name,--}}
{{--                                    'name' => $product->name,--}}
{{--                                    'description' => $product->description,--}}
{{--                                    'price' => $product->price_per_kg--}}
{{--                                ];--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                        <x-products-list :products="$productList" />--}}
{{--                        {{ $products->links() }}--}}
{{--                    @else--}}
{{--                        <p>{{ __("No products found.") }}</p>--}}
{{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>
{{-- emplea la petición AJAX para filtrar resultados en tiempo real --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#filter').on('keyup', function() {
                var filter = $(this).val();
                $.ajax({
                    url: '{{ route('products.index') }}',
                    type: 'GET',
                    data: { filter: filter },
                    success: function(data) {
                        $('#product-list').html(data);
                    }
                });
            });
        });
    </script>
</x-app-layout>

