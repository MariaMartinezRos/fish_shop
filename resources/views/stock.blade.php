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
                    {{ __("The stock section") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(isset($products) && count($products) > 0)
                        @php
                            $productList = [];
                            foreach($products as $product) {
                                $imagePath = 'images/'.$product->name.'.png';
                                $productList[] = [
                                    'image' => file_exists(public_path($imagePath)) ? asset($imagePath) : asset('images/default.png'),
                                    'alt' => $product->name,
                                    'name' => $product->name,
                                    'description' => $product->description,
                                    'price' => $product->price_per_kg
                                ];
                            }
                        @endphp
                        <x-products-list :products="$productList" />
                    @else
                        <p>{{ __("No products found.") }}</p>
                    @endif

{{--                    @if(isset($products) && count($products) > 0)--}}
{{--                        @foreach($products as $product)--}}
{{--                            @php--}}
{{--                                $products = [--}}
{{--                                        'image' =>  asset('images/'.$product->name.'.png'),--}}
{{--                                        'alt' => $product->name,--}}
{{--                                        'name' => $product->name,--}}
{{--                                        'description' => $product->description,--}}
{{--                                        'price' => $product->price_per_kg--}}
{{--                                    ];--}}
{{--                            @endphp--}}
{{--                            <x-products-list :products="$products" />--}}
{{--                        @endforeach--}}
{{--                        @else--}}
{{--                            <p>{{ __("No products found.") }}</p>--}}
{{--                        @endif--}}
    {{--                    @if(isset($products) && count($products) > 0)--}}
    {{--                        @foreach($products as $product)--}}
    {{--                            <h2>{{ __("Name: ") }}{{ $product->name }}</h2><br/>--}}
    {{--                            <h2>{{ __("Price (€/Kg): ") }}{{ $product->price_per_kg }}</h2><br/>--}}
    {{--                            <h2>{{ __("Description: ") }}{{ $product->description }}</h2><br/><br/>--}}
    {{--                        @endforeach--}}
    {{--                    @else--}}
    {{--                        <p>{{ __("No products found.") }}</p>--}}
    {{--                    @endif--}}
{{--                            @php--}}
{{--                                $products = [--}}
{{--                                    [--}}
{{--                                        'image' =>  asset('images/sardinas.png'),--}}
{{--                                        'alt' => 'sardinas',--}}
{{--                                        'name' => 'sardinas',--}}
{{--                                        'description' => 'sardinas',--}}
{{--                                        'price' => '$35'--}}
{{--                                    ],--}}
{{--                                    [--}}
{{--                                        'image' =>  asset('images/salmón.png'),--}}
{{--                                        'alt' => 'salmón',--}}
{{--                                        'name' => 'salmón',--}}
{{--                                        'description' => 'salmón',--}}
{{--                                        'price' => '$35'--}}
{{--                                    ]--}}
{{--                                ];--}}
{{--                        @endphp--}}


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

