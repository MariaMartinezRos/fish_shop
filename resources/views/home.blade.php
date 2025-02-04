<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">
<div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-lg w-full">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold"> {{ __('Benito\'s Fish Markets') }}</h1>
            <ul class="flex space-x-4">
                <li>
                    <a href="#about" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        {{ __('About us') }}
                    </a>
                </li>
                <li>
                    <a href="#products" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        {{ __('Products') }}
                    </a>
                </li>
                <li>
                    <a href="#shops" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        {{ __('Shops') }}
                    </a>
                </li>
                <li>
                    <a href="#recipees" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        {{ __('Recipes') }}
                    </a>
                </li>
                <li>
                    <a href="#discover" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        {{ __('Discover') }}
                    </a>
                </li>
                <li>
                    <a href="#contact" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        {{ __('Contact') }}
                    </a>
                </li>
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        @auth
                            <a
                                href="{{ url('/') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                {{__('Home')}}
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                {{ __('Log in')}}
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    {{ __('Register')}}
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-blue-500 text-white text-center py-20 w-full">
        <h2 class="text-4xl font-bold"> {{ __('Freshness from the sea to your table') }}</h2>
        <p class="mt-4 text-lg"> {{ __('The best seafood and fish selected for you.') }}</p>
    </header>

    <!-- Secciones -->
    <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">

    </div>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center py-4 w-full mt-12">
        <p>&copy; {{ __('1986 Benito\'s Fish Markets. All rights reserved.') }}</p>
        <p>836 846 209</p>
        <ul class="flex justify-center space-x-4 mt-2">
            <li><a href="#privacy" class="hover:underline"> {{ __('Privacy Policy') }}</a></li>
            <li><a href="#terms" class="hover:underline"> {{ __('Terms of Service') }}</a></li>
        </ul>
    </footer>
</div>
</body>
</html>
