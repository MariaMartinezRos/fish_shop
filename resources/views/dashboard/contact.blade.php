@include('partials.nav-bar-client')

<!-- Adding empty space -->
<div class="mt-20"></div>

<section id="contacto" class="bg-blue-950 text-white pt-20 pb-16 rounded-2xl mb-16">
    <div class="max-w-7xl mx-auto text-center px-4">
        <h2 class="text-4xl font-bold mb-8">{{ __('Contact Us') }}</h2>
        <p class="text-xl mb-6">{{ __('If you have any questions or need more information, feel free to get in touch with us.') }}</p>

        <!-- Formulario de contacto -->
        <form action="{{ route('contact.submit') }}" method="POST" class="max-w-2xl mx-auto bg-blue-700 p-8 rounded-lg shadow-lg space-y-6">
            <div>
                <label for="name" class="block text-blue-200 font-semibold">{{ __('Name') }}</label>
                <input type="text" id="name" name="name" required class=" text-black w-full px-4 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div>
                <label for="email" class="block text-blue-200 font-semibold">{{ __('Email Address') }}</label>
                <input type="email" id="email" name="email" required class="text-black w-full px-4 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div>
                <label for="message" class="block text-blue-200 font-semibold">{{ __('Message') }}</label>
                <textarea id="message" name="message" rows="4" required class="text-black w-full px-4 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-800 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-900 transition duration-300">{{ __('Send Message') }}</button>
            </div>
        </form>

        <div class="mt-10">
            <p class="text-xl mb-4">{{ __('Or if you prefer, send us an email directly:') }}</p>
            <a href="mailto:{{ config('app.name')}}" class="bg-white text-blue-800 px-6 py-3 rounded-full font-semibold hover:bg-blue-100 transition">{{ __('Send an Email') }}</a>
        </div>
    </div>
</section>

@include('partials.footer')
