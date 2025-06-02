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
        @if(empty($content))
            <section class="dashboard">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="#" class="panel-link">{{ __('Calendar')}}</a>
                    @livewire('employee.schedule-download')

                    {{--                <a href="#" class="panel-link text-red-600">{{ __('Schedule')}}</a>--}}
                    <a href="#" class="panel-link">{{ __('Download Paycheck')}}</a>
                    <a href="{{ route('employee.transactions') }}" class="panel-link">{{ __('Add a New Transaction')}}</a>
                    <a href="{{ route('employee.vacation-request') }}" class="panel-link">{{ __('Request vacation')}}</a>
                    <a href="#" class="panel-link">{{ __('Study')}}</a>
                </div>
            </section>
        @endif

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

    button {
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

    button:hover {
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
