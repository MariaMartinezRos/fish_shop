<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('products.index' ) }}">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <img src="{{ asset('images/go-back.png') }}" alt="{{ __('Go Back')}}" >
                {{ __('Go Back') }}
            </h2>
        </a>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">{{ __('Add Product') }}</h1>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">{{ __('Product Name') }}</label>
                    <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>

                @error('name')
                <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                    <p>{{ $message }}</p>
                </div>
                @enderror

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Category') }}</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <option value="">{{ __('Select Category') }}</option>
                        <option value="1">{{ __('Fresh') }}</option>
                        <option value="2">{{ __('Frozen') }}</option>
                        <option value="3">{{ __('Cut') }}</option>
                        <option value="4">{{ __('Seafood') }}</option>
                        <option value="5">{{ __('Other') }}</option>
                    </select>
                </div>

                @error('category_id')
                <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                    <p>{{ $message }}</p>
                </div>
                @enderror

                <div class="mb-4">
                    <label for="price_per_kg" class="block text-gray-700">{{ __('Price (€/Kg)') }}</label>
                    <input type="number" step="0.01" name="price_per_kg" id="price_per_kg" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>

                @error('price_per_kg')
                <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                    <p>{{ $message }}</p>
                </div>
                @enderror

                <div class="mb-4">
                    <label for="stock_kg" class="block text-gray-700">{{ __('Stock (Kg)') }}</label>
                    <input type="number" step="0.01" name="stock_kg" id="stock_kg" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>

                @error('stock_kg')
                <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                    <p>{{ $message }}</p>
                </div>
                @enderror

                <div class="mb-4">
                    <label for="description" class="block text-gray-700">{{ __('Description') }}</label>
                    <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
                </div>

                @error('description')
                <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                    <p>{{ $message }}</p>
                </div>
                @enderror

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">{{ __('Add Product') }}</button>
                </div>
            </form>
        </div>
    </div>
    </x-slot>
</x-app-layout>
