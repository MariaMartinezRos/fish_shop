<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fishes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @if(Auth::check() && Auth::user()->role_id === 1)

                    <form action="#" method="POST" enctype="multipart/form-data" class="flex flex-col items-end gap-4">
                        @csrf
                        <input type="file" name="file" accept=".xlsx"
                               class="file:border file:border-green-500 file:bg-green-100 file:text-green-700 file:rounded-lg file:px-4 file:py-2">

                        <div class="flex gap-2">

                            <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                {{ __('Add A Fish') }}
                            </button>

                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                                {{ __('Upload XLSX File') }}
                            </button>

                            <button type="submit" formaction="{{ route('products.delete-all') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                {{ __('Delete All Records') }}
                            </button>
                        </div>
                    </form>
                @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
