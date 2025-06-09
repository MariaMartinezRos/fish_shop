<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            @include('components.go-back')

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create User') }}
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
                    <h1 class="text-2xl font-bold mb-4">{{ __('Create User') }}</h1>

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input type="text" name="name" id="name" class="w-full" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input type="email" name="email" id="email" class="w-full" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input type="password" name="password" id="password" class="w-full" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-label for="password2" value="{{ __('Password Again') }}" />
                            <x-input type="password" name="password2" id="password2" class="w-full" required />
                            <x-input-error :messages="$errors->get('password2')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-label for="role_id" value="{{ __('Role') }}" />
                            <x-select 
                                name="role_id" 
                                :options="$roles"
                                placeholder="{{ __('Select Role') }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Create User') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
