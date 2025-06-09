<x-app-layout>
    <x-slot name="header">
        @include('components.go-back')


    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">{{ __('Add Product') }}</h1>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <x-label for="name" value="{{ __('Product Name') }}" />
                    <x-input type="text" name="name" id="name" class="w-full" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-label for="category_id" value="{{ __('Category') }}" />
                    <x-select 
                        name="category_id" 
                        :options="$categories"
                        placeholder="{{ __('Select Category') }}"
                        required
                    />
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-label for="price_per_kg" value="{{ __('Price (€/Kg)') }}" />
                    <x-input type="number" step="0.01" name="price_per_kg" id="price_per_kg" class="w-full" required />
                    <x-input-error :messages="$errors->get('price_per_kg')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-label for="stock_kg" value="{{ __('Stock (Kg)') }}" />
                    <x-input type="number" step="0.01" name="stock_kg" id="stock_kg" class="w-full" required />
                    <x-input-error :messages="$errors->get('stock_kg')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <x-input type="textarea" name="description" id="description" class="w-full" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">{{ __('Add Product') }}</button>
                </div>
            </form>
        </div>
    </div>
    </x-slot>
</x-app-layout>
