@include('partials.nav-bar-client')

<div class="flex justify-center items-center min-h-screen p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-200 p-12 rounded-2xl shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <img
                src="{{ asset('images/fishes/image05.jpg') }}"
                alt="{{ __('Benito\'s Fish Markets') }} TIENDA 1"
                class="w-full h-80 object-cover rounded-xl"
            />
            <div class="mt-8 text-center">
                <h2 class="text-3xl font-bold text-blue-800">{{ __('Benito\'s Fish Markets') }} ALHAMA</h2>
                <p class="text-blue-600">123 Seaside Ave, Miami, FL</p>
            </div>
        </div>
        <div class="bg-blue-200 p-12 rounded-2xl shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <img
                src="{{ asset('images/fishes/image07.jpg') }}"
                alt="{{ __('Benito\'s Fish Markets' ) }} TIENDA 2"
                class="w-full h-80 object-cover rounded-xl"
            />
            <div class="mt-8 text-center">
                <h2 class="text-3xl font-bold text-blue-800">{{ __('Benito\'s Fish Markets') }} LIBRILLA</h2>
                <p class="text-blue-600">456 Harbor St, San Diego, CA</p>
            </div>
        </div>
    </div>
</div>


@include('partials.footer')

