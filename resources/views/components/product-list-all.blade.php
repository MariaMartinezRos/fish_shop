<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.favicon')

    <title>{{ config('app.name', 'Fish Shop') }}</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    {{--        @livewireStyles--}}
</head>
<body class="font-sans antialiased">

<div class=" bg-gray-100 dark:bg-gray-900">
{{--    @include('layouts.navigation')--}}

    <!-- Page Heading -->
{{--    @isset($header)--}}
{{--        <header class="bg-white dark:bg-gray-800 shadow">--}}
{{--            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                {{ $header }}--}}
{{--            </div>--}}
{{--        </header>--}}
{{--    @endisset--}}

    <!-- Page Content -->
    <main>
{{--        {{ $slot }}--}}





<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="flex justify-between items-center gap-4 p-4">
                    <!-- Filter input on the left -->
                    <input type="text" id="filter" placeholder="{{ __('Filter products') }}"
                           class="border border-blue-500 text-blue-700 rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/3">

                    <!-- Form on the right -->
                    @if(Auth::check() && Auth::user()->role_id === 1)
                        <button type="button" onclick="window.location='{{ route('products.add-form') }}'" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            {{ __('Add A Product') }}
                        </button>
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-end gap-4">
                        @csrf
                        <input type="file" name="file" accept=".xlsx"
                               class="file:border file:border-green-500 file:bg-green-100 file:text-green-700 file:rounded-lg file:px-4 file:py-2">

                        <div class="flex gap-2">


                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                                {{ __('Upload XLSX File') }}
                            </button>

                            <button type="submit" formaction="{{ route('products.delete-all') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                {{ __('Delete All Records') }}
                            </button>
                        </div>
                    </form>
                    @endif
                </div>


                <!-- resources/views/components/product-list-all.blade.php -->

                <div id="product-list">
                    @include('components.product-list', ['products' => $products])
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
            </div>
        </div>
    </div>
</div>


    </main>
</div>
</body>
