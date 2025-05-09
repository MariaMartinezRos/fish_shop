
<div>
<div class="layout-container">
    <header>
        @include('partials.favicon')

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles

        <h1 class="text-3xl font-bold text-white">{{ $title }}</h1>
    </header>

    <body class="font-sans antialiased">
    @include('layouts.navigation')

    <div class="p-6"></div>
    <div class="p-6"></div>

    <main>

        <section class="dashboard">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="#" class="panel-link">{{ __('Calendar')}}</a>
                <a href="#" class="panel-link text-red-600">{{ __('Schedule')}}</a>
                <a href="#" class="panel-link">{{ __('Download Paycheck')}}</a>
                <a href="#" class="panel-link">{{ __('Assignements')}}</a>
                <a href="#" class="panel-link">{{ __('Reports')}}</a>
                <a href="#" class="panel-link">{{ __('Study')}}</a>
            </div>
        </section>


    @if (!empty($content))
            <section class="custom-content">
                {!! $content !!}
            </section>
        @endif
    </main>

    @include('partials.footer')

    @livewireScripts
    </body>
</div>

<style>
    .layout-container {
        font-family: 'Arial', sans-serif;
        background-color: #f4f9f4;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    header {
        background-color: #4CAF50;
        color: white;
        text-align: center;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    main {
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .dashboard {
        margin-bottom: 30px;
    }

    .panel-link {
        display: block;
        padding: 15px;
        background-color: #e0f2f1;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        transition: background-color 0.3s ease;
        text-decoration: none;
        color: #00695c;
    }

    .panel-link:hover {
        background-color: #b2dfdb;
    }

    .custom-content {
        margin-top: 30px;
        padding: 20px;
        background-color: #e8f5e9;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    footer {
        text-align: center;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    footer p {
        margin: 0;
    }
</style>
    </div>






{{--<div>--}}
{{--<div class="employee-layout-container">--}}
{{--    <header>--}}
{{--        @include('partials.favicon')--}}

{{--        <h1>{{ $title }}</h1>--}}

{{--        <!-- Fonts -->--}}
{{--        <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}

{{--        <!-- Scripts -->--}}
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

{{--        <!-- Styles -->--}}
{{--        @livewireStyles--}}
{{--    </header>--}}

{{--    <body class="font-sans antialiased">--}}
{{--    --}}{{--    min-h-screen bg-gray-100 dark:bg-gray-900 --}}
{{--    <div class=" bg-green-100 dark:bg-green-900">--}}
{{--        @include('layouts.navigation')--}}

{{--        <!-- Page Heading -->--}}
{{--        @isset($header)--}}
{{--            <header class="bg-white dark:bg-green-800 shadow">--}}
{{--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                    {{ $header }}--}}
{{--                </div>--}}
{{--            </header>--}}
{{--        @endisset--}}

{{--        <!-- Page Content -->--}}
{{--        <main>--}}

{{--        </main>--}}
{{--    </div>--}}

{{--    <section class="dashboard">--}}
{{--        <h2>Panel de Empleados</h2>--}}
{{--        <ul>--}}
{{--            <li><a href="#">Mi perfil</a></li>--}}
{{--            <li><a href="#">Tareas asignadas</a></li>--}}
{{--            <li><a href="#">Reportes</a></li>--}}
{{--            <li><a href="#">Cerrar sesión</a></li>--}}
{{--        </ul>--}}
{{--    </section>--}}

{{--    @livewireScripts--}}

{{--    @include('partials.footer')--}}

{{--    </body>--}}

{{--</div>--}}

{{--<style>--}}

{{--    .layout-container {--}}
{{--        font-family: 'Arial', sans-serif;--}}
{{--        background-color: #f4f9f4;--}}
{{--        margin: 0;--}}
{{--        padding: 0;--}}
{{--        min-height: 100vh;--}}
{{--    }--}}
{{--    main {--}}
{{--        padding: 40px 20px;--}}
{{--        max-width: 1200px;--}}
{{--        margin: 0 auto;--}}
{{--        background-color: white;--}}
{{--        border-radius: 8px;--}}
{{--        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);--}}
{{--    }--}}

{{--    footer {--}}
{{--        text-align: center;--}}
{{--        padding: 10px;--}}
{{--        background-color: #4CAF50;--}}
{{--        color: white;--}}
{{--        position: fixed;--}}
{{--        bottom: 0;--}}
{{--        width: 100%;--}}
{{--    }--}}

{{--    footer p {--}}
{{--        margin: 0;--}}
{{--    }--}}
{{--</style>--}}
{{--</div>--}}
