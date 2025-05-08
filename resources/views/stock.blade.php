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

