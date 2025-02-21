<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fish Shop') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">
<div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">

    @include('components.go-back')


    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-3xl font-bold text-center text-blue-700">{{ __('Terms of Service') }}</h1>
        <p class="text-center text-gray-600">{{ __('Last updated: January 2, 2025') }}</p>

        <p class="mt-4">{{ __('Welcome to') }} <strong>{{ __('Benito\'s Fish Markets') }}</strong>. {{ __('By using our website, you agree to comply with and be bound by the following terms and conditions. Please review them carefully.') }}</p>

        <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('1. Use of the Website') }}</h2>
        <p>{{ __('By accessing our site, you warrant that you are at least 18 years old or visiting with parental supervision.') }}</p>

        <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('2. Account and Security') }}</h2>
        <p>{{ __('When creating an account, you agree to provide accurate and complete information and to keep your credentials secure.') }}</p>

        <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('3. Prohibited Activities') }}</h2>
        <ul class="list-disc list-inside ml-4">
            <li>{{ __('Using our website for any unlawful purpose.') }}</li>
            <li>{{ __('Disrupting or interfering with website security or services.') }}</li>
            <li>{{ __('Engaging in fraudulent or misleading activities.') }}</li>
        </ul>

        <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('4. Limitation of Liability') }}</h2>
        <p>{{ __('Benito\'s Fish Markets is not responsible for any indirect or incidental damages resulting from the use of our services.') }}</p>

        <h2 class="text-2xl font-semibold text-blue-700 mt-6">{{ __('5. Changes to the Terms') }}</h2>
        <p>{{ __('We reserve the right to update these terms at any time. Continued use of our site constitutes acceptance of the new terms.') }}</p>

        <p class="mt-6 text-center font-semibold">{{ __('If you have any questions, contact us at') }} <span class="font-semibold">pescaderiasbenito@gmail.com</span>.</p>
    </div>

    @include('partials.footer')
</div>
</body>
</html>
