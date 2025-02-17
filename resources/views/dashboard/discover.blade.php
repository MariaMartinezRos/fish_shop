@include('partials.nav-bar-client')

@if(empty($fishes))
    <tr>
        <td colspan="5" class="px-6 py-4 text-center">
            {{ __('No fishes found') }}
        </td>
    </tr>
@else
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
    @foreach($fishes['data'] as $fish)
        <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
            <img src="{{ $fish['image'] ?? asset('images/default.png') }}" alt="{{ $fish['name'] }}" class="w-full h-40 object-cover rounded-t-lg">
            <div class="mt-4">
                <h3 class="text-xl font-semibold text-blue-900">{{ $fish['name'] }}</h3>
                <p class="text-sm text-blue-700 mt-2">{{ $fish['description'] }}</p>
                <p class="mt-2 text-sm text-blue-600 font-medium">{{ $fish['type'] }}</p>
            </div>
        </div>
    @endforeach
</div>
@endif

@include('partials.footer')
