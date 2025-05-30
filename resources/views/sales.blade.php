<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6  text-gray-900 dark:text-gray-100">
                    {{ __("Today's money: ") }}{{ $totalAmount }} €
                </div>
                <div class="p-6  text-gray-900 dark:text-gray-100">
                    {{ __("Today's clients: ") }}{{ $totalClients }}
                </div>
                <form action="{{ route('soft-deletes') }}" method="POST" class="p-6 inline">
                    @csrf
                    <button
                        type="submit"
                        class="px-4 py-2 bg-lime-500 text-white rounded-md hover:bg-lime-600 focus:outline-none focus:ring-2 focus:ring-lime-400">
                        {{ __('Soft Deletes Report') }}
                    </button>
                </form>

                <form action="{{ route('run.command') }}" method="POST" class="p-6 ">
                    @csrf
                    <button
                        type="submit"
                        class="px-4 py-2 bg-fuchsia-500 text-white rounded-md hover:bg-fuchsia-600 focus:outline-none focus:ring-2 focus:ring-fuchsia-400">
                    {{ __('Refresh') }}
{{--                        borra todo el cache y los logs--}}
                    </button>
                </form>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- renderiza el grafico --}}
                    {!! $chartHour->container() !!}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- renderiza el grafico --}}
                    {!! $chartWeek->container() !!}
                </div>
            </div>
        </div>
    </div>
    {{-- llama a la libreria del grafico --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{ $chartHour->script() }}
    {{ $chartWeek->script() }}

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('toast'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: "{{ session('toast')['type'] }}",
                    title: "{{ session('toast')['message'] }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif
</x-app-layout>
