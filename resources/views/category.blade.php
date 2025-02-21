<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">




                <div class="p-6 text-black">
                    @if(isset($categories) && count($categories) > 0)
                        <div class="space-y-4">
                            @foreach($categories as $category)
                                <div class="flex items-center justify-center p-4 bg-gradient-to-r from-indigo-300 to-purple-300 text-black rounded-lg shadow-lg
                    hover:bg-opacity-80 hover:text-white hover:shadow-xl hover:bg-gradient-to-r hover:from-indigo-400 hover:to-purple-400 transition-all ">
                                    <h2 class="text-xl font-semibold">{{ $category->name }}</h2>
                                    <img src="{{ asset('images/'.$category->id.'.png') }}" alt="{{ __('Category of the fish') }}"
                                         class="h-6 w-6 ml-2"
                                         onerror="this.onerror=null; this.src='{{ asset('images/0.png') }}';">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                            <p class="text-lg text-gray-600 dark:text-gray-400">{{ __("No categories found.") }}</p>
                        </div>
                    @endif
                </div>

                {{--                <div class="p-6 text-black">--}}
{{--                    @if(isset($categories) && count($categories) > 0)--}}
{{--                        <div class="space-y-4">--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <div class="flex items-center justify-center p-4 bg-gradient-to-r from-indigo-200 to-purple-200 text-black rounded-lg shadow-lg">--}}
{{--                                    <h2 class="text-xl font-semibold">{{ $category->name }}</h2>--}}
{{--                                    <img src="{{ asset('images/'.$category->id.'.png') }}" alt="{{ __('Category of the fish') }}"--}}
{{--                                         class="h-6 w-6 ml-2"--}}
{{--                                         onerror="this.onerror=null; this.src='{{ asset('images/0.png') }}';">--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">--}}
{{--                            <p class="text-lg text-gray-600 dark:text-gray-400">{{ __("No categories found.") }}</p>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}

                {{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    @if(isset($categories) && count($categories) > 0)--}}
{{--                        <div class="space-y-4">--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <div class="p-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg shadow-lg">--}}
{{--                                    <h2 class="text-xl font-semibold">{{ $category->name }}</h2>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">--}}
{{--                            <p class="text-lg text-gray-600 dark:text-gray-400">{{ __("No categories found.") }}</p>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}


                {{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    @if(isset($categories) && count($categories) > 0)--}}
{{--                        <div class="space-y-4">--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $category->name }}</h2>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <p class="text-lg text-gray-600 dark:text-gray-400">{{ __("No categories found.") }}</p>--}}
{{--                    @endif--}}
{{--                </div>--}}

                {{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    @if(isset($categories) && count($categories) > 0)--}}
{{--                        @foreach($categories as $category)--}}
{{--                            <h2>{{ $category->name }}</h2>--}}
{{--                        @endforeach--}}
{{--                    @else--}}
{{--                        <p>{{ __("No categories found.") }}</p>--}}
{{--                    @endif--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</x-app-layout>
