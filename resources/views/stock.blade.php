<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stock') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-black p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @else
            <div>

            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div id="product-list">
                        @include('components.product-list-all', ['products' => $products])
                    </div>

            </div>
        </div>
    </div>
{{-- emplea la petición AJAX para filtrar resultados en tiempo real --}}
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#filter').on('keyup', function() {--}}
{{--                var filter = $(this).val();--}}
{{--                $.ajax({--}}
{{--                    url: '{{ route('products.index') }}',--}}
{{--                    type: 'GET',--}}
{{--                    data: { filter: filter },--}}
{{--                    success: function(data) {--}}
{{--                        $('#product-list').html(data);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
</x-app-layout>

