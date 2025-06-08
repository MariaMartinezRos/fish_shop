
<div>
    <div class="relative w-full max-w-4xl mx-auto">
        @if (session('error'))
            <div class="bg-red-500 text-white text-center py-2 px-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="overflow-hidden relative">
            <div class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(-{{ $currentIndex * 100 }}%);">
                @foreach($images as $image)
                    <div class="w-full flex-shrink-0">
                        <img src="{{ $image }}" alt="{{ __('Carousel Image') }}" class="w-full h-64 object-cover rounded-lg shadow-lg">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Navigation Buttons -->
        <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full" wire:click="previous">
            &#10094;
        </button>
        <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full" wire:click="next">
            &#10095;
        </button>
    </div>
</div>
