<div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-lg w-full">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Pescaderías Benito</h1>
            <ul class="flex space-x-4">
                <li><a href="#about" class="hover:underline">Nosotros</a></li>
                <li><a href="#products" class="hover:underline">Productos</a></li>
                <li><a href="#shops" class="hover:underline">Tiendas</a></li>
                <li><a href="#recipees" class="hover:underline">Recetas</a></li>
                <li><a href="#discover" class="hover:underline">Descubre</a></li>
                <li><a href="#contact" class="hover:underline">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-blue-500 text-white text-center py-20 w-full">
        <h2 class="text-4xl font-bold">Frescura del mar a tu mesa</h2>
        <p class="mt-4 text-lg">Los mejores mariscos y pescados seleccionados para ti.</p>
    </header>

    <!-- Secciones -->
    <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
        {{ $slot }}
    </div>
</div>

{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}

{{--    <!-- Scripts -->--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--</head>--}}
{{--<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">--}}
{{--<div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">--}}
{{--    <!-- Navbar -->--}}
{{--    <nav class="bg-blue-600 text-white p-4 shadow-lg w-full">--}}
{{--        <div class="container mx-auto flex justify-between items-center">--}}
{{--            <h1 class="text-2xl font-bold">Pescaderías Benito</h1>--}}
{{--            <ul class="flex space-x-4">--}}
{{--                <li><a href="#about" class="hover:underline">Nosotros</a></li>--}}
{{--                <li><a href="#products" class="hover:underline">Productos</a></li>--}}
{{--                <li><a href="#shops" class="hover:underline">Tiendas</a></li>--}}
{{--                <li><a href="#recipees" class="hover:underline">Recetas</a></li>--}}
{{--                <li><a href="#discover" class="hover:underline">Descubre</a></li>--}}
{{--                <li><a href="#contact" class="hover:underline">Contacto</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </nav>--}}

{{--    <!-- Hero Section -->--}}
{{--    <header class="bg-blue-500 text-white text-center py-20 w-full">--}}
{{--        <h2 class="text-4xl font-bold">Frescura del mar a tu mesa</h2>--}}
{{--        <p class="mt-4 text-lg">Los mejores mariscos y pescados seleccionados para ti.</p>--}}
{{--    </header>--}}

{{--    <!-- Secciones -->--}}
{{--    <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">--}}
{{--        <!-- Productos -->--}}
{{--        <section id="products" class="my-12">--}}
{{--            <h3 class="text-3xl font-semibold text-blue-700 text-center">Nuestros Productos</h3>--}}
{{--            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">--}}
{{--                @foreach (['Salmón', 'Atún', 'Camarones', 'Pulpo', 'Merluza', 'Ostras'] as $producto)--}}
{{--                    <div class="bg-white p-4 rounded-xl shadow-md text-center">--}}
{{--                        <h4 class="text-xl font-medium text-blue-800">{{ $producto }}</h4>--}}
{{--                        <p class="text-gray-600 mt-2">Fresco y de la mejor calidad</p>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </section>--}}

{{--        <!-- Tiendas -->--}}
{{--        <section id="shops" class="my-12 text-center">--}}
{{--            <h3 class="text-3xl font-semibold text-blue-700">Nuestras Tiendas</h3>--}}
{{--            <p class="text-gray-700 mt-4">Encuentra la tienda más cercana y disfruta de nuestros productos frescos.</p>--}}
{{--        </section>--}}

{{--        <!-- Recetas -->--}}
{{--        <section id="recipees" class="bg-blue-100 py-12 text-center">--}}
{{--            <h3 class="text-3xl font-semibold text-blue-700">Recetas</h3>--}}
{{--            <p class="text-gray-700 mt-4">Descubre deliciosas recetas para preparar con nuestros productos.</p>--}}
{{--        </section>--}}

{{--        <!-- Descubre -->--}}
{{--        <section id="discover" class="my-12 text-center">--}}
{{--            <h3 class="text-3xl font-semibold text-blue-700">Descubre</h3>--}}
{{--            <p class="text-gray-700 mt-4">Conoce más sobre el mundo del mar y nuestros procesos de selección.</p>--}}
{{--        </section>--}}

{{--        <!-- Contacto -->--}}
{{--        <section id="contact" class="bg-blue-100 py-12 text-center">--}}
{{--            <h3 class="text-3xl font-semibold text-blue-700">Contáctanos</h3>--}}
{{--            <p class="text-gray-700 mt-4">Visítanos o llámanos para hacer tu pedido</p>--}}
{{--        </section>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
