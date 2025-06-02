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
                                {{ __('Status') }}
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
                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">{{ $user->role->display_name ?? __('No Role') }}</td>

                                <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-700">
                                    @if($user->role->name === 'employee')
                                        @php
                                            $latestVacation = $user->vacationRequests()->latest()->first();
                                        @endphp
                                        @if($latestVacation)
                                            @switch($latestVacation->status)
                                                @case('pending')
                                                    <div wire:key="pending-{{ $latestVacation->id }}">
                                                        <img src="{{ asset('images/available-dot.png') }}" 
                                                             alt="Pending" 
                                                             class="w-4 h-4 inline-block align-middle cursor-pointer" 
                                                             title="Pending"
                                                             onclick="Livewire.dispatch('showVacationModal', { requestId: {{ $latestVacation->id }}, type: 'pending' })">
                                                    </div>
                                                    @break
                                                @case('approved')
                                                    <div wire:key="approved-{{ $latestVacation->id }}">
                                                        <img src="{{ asset('images/unavailable-dot.png') }}" 
                                                             alt="Approved" 
                                                             class="w-4 h-4 inline-block align-middle cursor-pointer" 
                                                             title="Approved"
                                                             onclick="Livewire.dispatch('showVacationModal', { requestId: {{ $latestVacation->id }}, type: 'approved' })">
                                                    </div>
                                                    @break
                                                @case('rejected')
                                                    <img src="{{ asset('images/available-dot.png') }}" alt="Rejected" class="w-4 h-4 inline-block align-middle" title="Rejected">
                                                    @break
                                                @default
                                                    <img src="{{ asset('images/available-dot.png') }}" alt="Pending" class="w-4 h-4 inline-block align-middle" title="Pending">
                                            @endswitch
                                        @else
                                            <img src="{{ asset('images/available-dot.png') }}" alt="Pending" class="w-4 h-4 inline-block align-middle" title="Pending">
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>

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

    <div>
        @livewire('vacation-request-actions')
    </div>
</x-app-layout>
