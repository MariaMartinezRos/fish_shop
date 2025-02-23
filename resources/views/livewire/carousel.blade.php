{{--<div>--}}
{{--    <div class="relative w-full max-w-4xl mx-auto">--}}
{{--        <div class="overflow-hidden relative">--}}
{{--            <div class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(0%);">--}}
{{--                @foreach($images as $image)--}}
{{--                    <div class="w-full flex-shrink-0">--}}
{{--                        <img src="{{ $image }}" alt="Carousel Image" class="w-full h-64 object-cover rounded-lg shadow-lg">--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Navigation Buttons -->--}}
{{--        <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full" wire:click="previous">--}}
{{--            &#10094;--}}
{{--        </button>--}}
{{--        <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full" wire:click="next">--}}
{{--            &#10095;--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</div>--}}

<div>
    <div class="relative w-full max-w-4xl mx-auto">
        <div class="overflow-hidden relative">
            <div class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(-{{ $currentIndex * 100 }}%);">
                @foreach($images as $image)
                    <div class="w-full flex-shrink-0">
                        <img src="{{ $image }}" alt="Carousel Image" class="w-full h-64 object-cover rounded-lg shadow-lg">
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

{{--<div>--}}
{{--    <div class="relative w-full max-w-4xl mx-auto">--}}
{{--        <div class="overflow-hidden relative">--}}
{{--            <div class="flex transition-transform duration-500 ease-in-out"--}}
{{--                 style="transform: translateX(-{{ $currentIndex * 100 }}%);">--}}
{{--                @foreach($images as $image)--}}
{{--                    <div class="w-full flex-shrink-0">--}}
{{--                        <img src="{{ $image }}" alt="Carousel Image" class="w-full h-64 object-cover rounded-lg shadow-lg">--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Navigation Buttons -->--}}
{{--        <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full"--}}
{{--                wire:click="previous" wire:loading.attr="disabled">--}}
{{--            &#10094;--}}
{{--        </button>--}}
{{--        <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full"--}}
{{--                wire:click="next" wire:loading.attr="disabled">--}}
{{--            &#10095;--}}
{{--        </button>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div>--}}
{{--    <div class="relative w-full max-w-4xl mx-auto">--}}
{{--        <div class="overflow-hidden relative">--}}
{{--            <div class="flex transition-transform duration-500 ease-in-out"--}}
{{--                 style="transform: translateX(-{{ $currentIndex * 100 }}%);">--}}
{{--                @foreach($images as $image)--}}
{{--                    <div class="w-full flex-shrink-0">--}}
{{--                        <img src="{{ $image }}" alt="Carousel Image" class="w-full h-64 object-cover rounded-lg shadow-lg">--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div>--}}
{{--    <div class="relative w-full max-w-4xl mx-auto">--}}
{{--        <div class="overflow-hidden relative">--}}
{{--            <div class="flex transition-transform duration-500 ease-in-out"--}}
{{--                 style="transform: translateX(-{{ $currentIndex * 100 }}%);">--}}
{{--                @foreach($images as $image)--}}
{{--                    <div class="w-full flex-shrink-0">--}}
{{--                        <img src="{{ $image }}" alt="Carousel Image" class="w-full h-64 object-cover rounded-lg shadow-lg">--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div>--}}
{{--    <!-- Carousel Container -->--}}
{{--    <div class="relative w-full max-w-3xl mx-auto">--}}
{{--        <div class="overflow-hidden rounded-lg">--}}
{{--            <img src="{{ $images[$currentImageIndex] ?? '' }}" alt="Fish Image" class="w-full h-80 object-cover transition-all duration-700">--}}
{{--        </div>--}}

{{--        <!-- Carousel Controls (optional) -->--}}
{{--        <button wire:click="nextImage" class="absolute top-1/2 left-4 transform -translate-y-1/2 text-white bg-black bg-opacity-50 p-2 rounded-full">--}}
{{--            &#10094;--}}
{{--        </button>--}}
{{--        <button wire:click="nextImage" class="absolute top-1/2 right-4 transform -translate-y-1/2 text-white bg-black bg-opacity-50 p-2 rounded-full">--}}
{{--            &#10095;--}}
{{--        </button>--}}
{{--    </div>--}}

{{--    <!-- Inline Script to auto-change image every 2 seconds -->--}}
{{--    <script>--}}
{{--        document.addEventListener('livewire:load', function () {--}}
{{--            setInterval(function () {--}}
{{--                @this.call('nextImage'); // Call the nextImage method every 2 seconds--}}
{{--            }, 2000);--}}
{{--        });--}}
{{--    </script>--}}
{{--</div>--}}
