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
                @if(Auth::check() && Auth::user()->role_id === 'admin')
                        <button type="button" onclick="window.location='{{ route('fishes.create') }}'" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            {{ __('Add A Fish') }}
                        </button>
{{--                        <button type="submit" formaction="{{ route('fishes.delete-all') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">--}}
{{--                            {{ __('Delete All Records') }}--}}
{{--                        </button>--}}
                @endif

                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-auto w-full text-left">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-xs tracking-widest text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                                    {{ __('Image') }}
                                </th>
                                <th class="px-6 py-3 text-xs tracking-widest text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                                    {{ __('Name') }}
                                </th>
                                <th class="px-6 py-3 text-xs tracking-widest text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                                    {{ __('Description') }}
                                </th>
                                <th class="px-6 py-3 text-xs tracking-widest text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                                    {{ __('Type') }}
                                </th>
                                <th class="px-6 py-3 text-xs tracking-widest text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                                    {{ __('Options') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(empty($fishes))
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">
                                    {{ __('No fishes found') }}
                                </td>
                            </tr>
                        @else
                            @foreach($fishes['data'] as $fish)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ $fish['image'] ?? asset('images/default.png') }}" alt="{{ $fish['name'] }}" class="w-12 h-12 object-cover rounded-md">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fish['name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Str::words($fish['description'], 5, '...') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fish['type'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-between">
                                            <a href="{{ route('fishes.edit', ['fish' => $fish['id']]) }}" class="text-blue-600 dark:text-blue-400">{{ __('Edit') }}</a>
                                            <form action="{{ url('api_v2/fishes/' . $fish['id']) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 ml-2">{{ __('Delete') }}</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
