<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
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
                    <a href="{{ route('users.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">{{ __('Create User') }}</a>
{{--                    <a href="{{ route('users.deleteAll') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">{{ __('Delete All Users') }}</a>--}}

                    <table class="table-auto w-full text-left">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs tracking-widest text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                                {{ __('Name') }}
                            </th>
                            <th class="px-6 py-3 text-xs tracking-widest text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                                {{ __('Email') }}
                            </th>
                            <th class="px-6 py-3 text-xs tracking-widest text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                                {{ __('Role') }}
                            </th>
                            <th class="px-6 py-3 text-xs tracking-widest text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->name }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->email }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->role_id }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">
                                    <div class="flex justify-between">
                                        <a href="{{ route('users.edit', $user) }}" class="text-blue-600 dark:text-blue-400">{{ __('Edit') }}</a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 ml-2">{{ __('Delete') }}</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap" colspan="4">
                                    {{ __('No records found') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
