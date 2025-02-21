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

    <main>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="flex flex-col md:flex-row justify-between items-center gap-4 p-4">
                    @if(Auth::check() && Auth::user()->role_id === 'admin')
                        <form method="GET" action="{{ route('products.index') }}" class="w-full md:w-auto">
                            <input type="text" name="search" id="search" placeholder="{{ __('Filter products') }}"
                                   class="border border-blue-500 text-blue-700 rounded-lg px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-1/3"
                                   value="{{ request()->query('filter') }}">
                        </form>

                </div>

                <!-- Upload and Delete All Records Form (only visible to admin) -->
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-end gap-4 mt-4 md:mt-8">
                        @csrf

                        <!-- File upload input -->
                        <input type="file" name="file" accept=".xlsx"
                               class="file:border file:border-green-500 file:bg-green-100 file:text-green-700 file:rounded-lg file:px-4 file:py-2 w-full md:w-auto">

                        <!-- Action buttons for file upload and delete all records -->
                        <div class="flex flex-col md:flex-row gap-4 mt-4 w-full md:w-auto">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition w-full md:w-auto">
                                {{ __('Upload XLSX File') }}
                            </button>

                            <button type="submit" formaction="{{ route('products.delete-all') }}"
                                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition w-full md:w-auto">
                                {{ __('Delete All Records') }}
                            </button>
                        </div>

                        <button type="button" onclick="window.location='{{ route('products.create') }}'"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition w-full md:w-auto">
                            {{ __('Add A Product') }}
                        </button>
                    </form>
                @endif

                <!-- Download PDF button -->
                <button type="button" onclick="window.location='{{ route('products.pdf') }}'"
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition w-full md:w-auto mb-4 md:mb-0">
                    {{ __('Download All Products') }}
                </button>

                <!-- Product list -->
                <div id="product-list" class="mt-8">
                    @include('components.product-list', ['products' => $products])
                </div>


            </div>
        </div>
    </div>
</div>


    </main>
</div>
</body>
