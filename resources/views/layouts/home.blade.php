{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    @include('partials.favicon')--}}

{{--    <title>{{ config('app.name', 'Fish Shop') }}</title>--}}


{{--    <!-- Fonts -->--}}
{{--    <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}

{{--    <!-- Scripts -->--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

{{--    <!-- Styles -->--}}
{{--    --}}{{--        @livewireStyles--}}
{{--</head>--}}
{{--<body class="font-sans antialiased">--}}
{{--<div class=" bg-gray-100 dark:bg-gray-900">--}}

{{--    <nav class="bg-blue-600 text-white p-4 shadow-lg w-full">--}}
{{--        <div class="container mx-auto flex justify-between items-center">--}}
{{--            <h1 class="text-2xl font-bold"> {{ __('Benito\'s Fish Markets') }}</h1>--}}
{{--            <ul class="flex space-x-4">--}}
{{--                <li>--}}
{{--                    <a href="#about" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">--}}
{{--                        {{ __('About us') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#products" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">--}}
{{--                        {{ __('Products') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#shops" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">--}}
{{--                        {{ __('Shops') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#recipees" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">--}}
{{--                        {{ __('Recipes') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="#contact" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">--}}
{{--                        {{ __('Contact') }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @if (Route::has('login'))--}}
{{--                    <nav class="-mx-3 flex flex-1 justify-end">--}}
{{--                        @auth--}}
{{--                            <!-- Responsive Settings Options -->--}}
{{--                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>--}}

{{--                            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">--}}

{{--                                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">--}}
{{--                                    <div class="px-4">--}}
{{--                                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>--}}
{{--                                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>--}}
{{--                                    </div>--}}

{{--                                    <div class="mt-3 space-y-1">--}}
{{--                                        <x-responsive-nav-link :href="route('profile.edit')">--}}
{{--                                            {{ __('Profile') }}--}}
{{--                                        </x-responsive-nav-link>--}}

{{--                                        <!-- Authentication -->--}}
{{--                                        <form method="POST" action="{{ route('logout') }}">--}}
{{--                                            @csrf--}}

{{--                                            <x-responsive-nav-link :href="route('logout')"--}}
{{--                                                                   onclick="event.preventDefault();--}}
{{--                                        this.closest('form').submit();">--}}
{{--                                                {{ __('Log Out') }}--}}
{{--                                            </x-responsive-nav-link>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <a--}}
{{--                                href="{{ route('login') }}"--}}
{{--                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
{{--                            >--}}
{{--                                {{ __('Log in')}}--}}
{{--                            </a>--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <a--}}
{{--                                    href="{{ route('register') }}"--}}
{{--                                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
{{--                                >--}}
{{--                                    {{ __('Register')}}--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                        @endauth--}}
{{--                    </nav>--}}
{{--                @endif--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </nav>--}}

{{--    <!-- Page Content -->--}}
{{--    <main>--}}
{{--        {{ $slot }}--}}
{{--    </main>--}}
{{--</div>--}}

{{--@include('partials.footer')--}}

{{--</body>--}}
{{--</html>--}}
