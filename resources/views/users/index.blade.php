<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
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

{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Users') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    <h1 class="text-2xl font-bold mb-4">{{ __('Users') }}</h1>--}}
{{--                    <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">{{ __('Create User') }}</a>--}}

{{--                    <table class="min-w-full bg-white dark:bg-gray-800">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-blue-600 dark:text-blue-400 tracking-wider">{{ __('Name') }}</th>--}}
{{--                            <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-blue-600 dark:text-blue-400 tracking-wider">{{ __('Email') }}</th>--}}
{{--                            <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-blue-600 dark:text-blue-400 tracking-wider">{{ __('Role') }}</th>--}}
{{--                            <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-blue-600 dark:text-blue-400 tracking-wider">{{ __('Actions') }}</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($users as $user)--}}
{{--                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">--}}
{{--                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->name }}</td>--}}
{{--                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->email }}</td>--}}
{{--                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->role_id }}</td>--}}
{{--                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">--}}
{{--                                    <a href="{{ route('users.edit', $user) }}" class="text-blue-600 dark:text-blue-400">{{ __('Edit') }}</a>--}}
{{--                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="text-red-600 dark:text-red-400 ml-2">{{ __('Delete') }}</button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}

{{--                    @if($users->isEmpty())--}}
{{--                        <p class="mt-4">{{ __('No users found.') }}</p>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}


{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Users') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    <h1 class="text-2xl font-bold mb-4">{{ __('Users') }}</h1>--}}
{{--                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-4">{{ __('Create User') }}</a>--}}

{{--                    <table class="min-w-full bg-white dark:bg-gray-800">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-gray-600 dark:text-gray-400 tracking-wider">{{ __('Name') }}</th>--}}
{{--                            <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-gray-600 dark:text-gray-400 tracking-wider">{{ __('Email') }}</th>--}}
{{--                            <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-gray-600 dark:text-gray-400 tracking-wider">{{ __('Role') }}</th>--}}
{{--                            <th class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left leading-4 text-gray-600 dark:text-gray-400 tracking-wider">{{ __('Actions') }}</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($users as $user)--}}
{{--                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">--}}
{{--                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->name }}</td>--}}
{{--                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->email }}</td>--}}
{{--                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->role_id }}</td>--}}
{{--                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">--}}
{{--                                    <a href="{{ route('users.edit', $user) }}" class="text-blue-600 dark:text-blue-400">{{ __('Edit') }}</a>--}}
{{--                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="text-red-600 dark:text-red-400 ml-2">{{ __('Delete') }}</button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}

{{--                    @if($users->isEmpty())--}}
{{--                        <p class="mt-4">{{ __('No users found.') }}</p>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}


{{--<x-app-layout>--}}

{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Users') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <h1>{{ __('Users') }}</h1>--}}
{{--    <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __(' Create User') }}</a>--}}

{{--    <table>--}}
{{--        <tr>--}}
{{--            <th>{{ __('Name') }}</th>--}}
{{--            <th>{{ __('Email') }}</th>--}}
{{--            <th>{{ __('Role') }}</th>--}}
{{--            <th>{{ __('Actions') }}</th>--}}
{{--        </tr>--}}
{{--        @foreach ($users as $user)--}}
{{--            <tr>--}}
{{--                <td>{{ $user->name }}</td>--}}
{{--                <td>{{ $user->email }}</td>--}}
{{--                <td>{{ $user->role_id }}</td>--}}
{{--                <td>--}}
{{--                    <a href="{{ route('users.edit', $user) }}">{{ __('Edit') }}</a>--}}
{{--                    <form action="{{ route('users.destroy', $user) }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button type="submit">{{ __('Delete') }}</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--    </table>--}}
{{--</x-app-layout>--}}
