<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Today's money: ") }}{{ $totalAmount }} €
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Today's clients: ") }}{{ $totalClients }}
                </div>
                <form action="{{ route('soft-deletes') }}" method="POST" class="inline">
                    @csrf
                    <button
                        type="submit"
                        class="px-4 py-2 bg-lime-500 text-white rounded-md hover:bg-lime-600 focus:outline-none focus:ring-2 focus:ring-lime-400">
                        {{ __('Soft Deletes Report') }}
                    </button>
                </form>
                <div class="p-6 text-gray-900 dark:text-gray-100">
{{--                    renderiza el grafico--}}
                    {!! $chartHour->container() !!}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{--                    renderiza el grafico--}}
                    {!! $chartWeek->container() !!}
                </div>
            </div>
        </div>
    </div>
    {{-- llama a la libreria del grafico --}}
{{--    <script src="{{ $chart->cdn() }}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{ $chartHour->script() }}
    {{ $chartWeek->script() }}
</x-app-layout>
