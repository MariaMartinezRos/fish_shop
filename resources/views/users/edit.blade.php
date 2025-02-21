<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            @include('components.go-back')

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div>
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
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">{{ __('Edit User') }}</h1>

                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>

                        @error('name')
                        <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                        @enderror

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        </div>

                        @error('email')
                        <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                        @enderror

                        <div class="mb-4">
                            <label for="role_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Role') }}</label>
                            <select name="role_id" id="role_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                                <option value="">{{ __('Select Role') }}</option>
                                <option value="1">{{ __('Admin') }}</option>
                                <option value="3">{{ __('Employee') }}</option>
                                <option value="4">{{ __('Customer') }}</option>
                            </select>
                        </div>

                        @error('role_id')
                        <div class="bg-red-100 border-l-4 border-red-500 text-black p-4 mb-4" role="alert">
                            <p>{{ $message }}</p>
                        </div>
                        @enderror

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Update User') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
