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
                        @if(true === true)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap" colspan="5">
                                    {{ __('No records found') }}
                                </td>
                            </tr>
                        @else
                        @foreach($fishes as $fish)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('images/fishes/image'. $fish->id.'.jpg') }}" alt="{{ $fish->name }}" class="w-12 h-12 object-cover rounded-md">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $fish->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $fish->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $fish->type }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
{{--                                    @if(Auth::check() && Auth::user()->role_id === 1)--}}
{{--                                        <form action="{{ route('fish.destroy', $fish->id) }}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">--}}
{{--                                                {{ __('Delete') }}--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    @endif--}}
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
