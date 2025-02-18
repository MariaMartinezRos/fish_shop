@include('partials.nav-bar-client')

<!-- Adding empty space -->
<div class="mt-20"></div>

<section id="nosotros" class="bg-blue-200 pt-20 pb-16 rounded-2xl">
    <div class="max-w-7xl mx-auto text-center px-4">
        <h2 class="text-4xl font-bold text-blue-800 mb-8">{{ __('Who We Are') }}</h2>
        <p class="text-xl text-blue-700 mb-4">
            {{ __('At Benito\'s Fish Markets, we are dedicated to offering the freshest and highest quality seafood. Our mission is to bring the best fish and seafood directly to our customers\' tables, ensuring a fresh and delicious product every day.') }}
        </p>
        <p class="text-xl text-blue-700 mb-8">
            {{ __('With over 20 years of experience in the industry, we are a benchmark in the fishing sector, working hand in hand with the best local fishermen.') }}
        </p>
        <div class="flex justify-center gap-8">
            <div class="max-w-xs">
                <h3 class="text-2xl font-semibold text-blue-800 mb-4">{{ __('Guaranteed Quality') }}</h3>
                <p class="text-blue-700">{{ __('We work only with fresh and sustainable products, ensuring that every fish and seafood we offer meets the highest quality standards.') }}</p>
            </div>
            <div class="max-w-xs">
                <h3 class="text-2xl font-semibold text-blue-800 mb-4">{{ __('Commitment to the Environment') }}</h3>
                <p class="text-blue-700">{{ __('We care about the future of the oceans. That\'s why we carefully select our sources, supporting sustainable fishing practices.') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Adding empty space -->
<div class="mt-20"></div>

<!-- Contact Section -->
<section id="contacto" class="bg-blue-950 text-white pt-20 pb-16 rounded-2xl mb-16">
    <div class="max-w-7xl mx-auto text-center px-4">
        <h2 class="text-4xl font-bold mb-8">{{ __('Contact Us') }}</h2>
        <p class="text-xl mb-6">{{ __('If you have any questions or need more information, feel free to get in touch with us.') }}</p>
        <a href="mailto:{{config('app.name')}}" class="bg-white text-blue-800 px-6 py-3 rounded-full font-semibold hover:bg-blue-100 transition">{{ __('Send Us an Email') }}</a>
    </div>
</section>

@include('partials.footer')

