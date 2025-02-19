<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <a href="{{ route('fish') }}">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <img src="{{ asset('images/go-back.png') }}" alt="{{ __('Go Back') }}">
                    {{ __('Go Back') }}
                </h2>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Fish') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">{{ __('Edit Fish') }}</h1>

                    <form action="{{ url('api_v2/fishes/' . $fish->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Fish Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Fish Name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $fish->name) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>

                        @error('name')
                        <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                        @enderror

                        <!-- Fish Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>{{ old('description', $fish->description) }}</textarea>
                        </div>

                        @error('description')
                        <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                        @enderror

                        <!-- Fish Type -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Fish Type') }}</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                <option value="">{{ __('Select Type') }}</option>
                                <option value="freshwater" {{ old('type', $fish->type) == 'freshwater' ? 'selected' : '' }}>{{ __('Freshwater') }}</option>
                                <option value="saltwater" {{ old('type', $fish->type) == 'saltwater' ? 'selected' : '' }}>{{ __('Saltwater') }}</option>
                            </select>
                        </div>

                        @error('type')
                        <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                        @enderror

                        <!-- Fish Image (Optional) -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Fish Image') }}</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" accept="image/*">
                        </div>

                        @error('image')
                        <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                        @enderror

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Update Fish') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
