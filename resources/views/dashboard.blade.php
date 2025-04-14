    <!-- Navbar -->
    @include('partials.nav-bar-client')

    <!-- Hero Section -->
    <header class="bg-blue-500 text-white text-center py-20 w-full">
        <h2 class="text-4xl font-bold"> {{ __('Freshness from the sea to your table') }}</h2>
        <p class="mt-4 text-lg"> {{ __('The best seafood and fish selected for you.') }}</p>
    </header>
    <div class="mt-10"></div>

    <!-- Secciones -->
    <livewire:carousel />


{{--    <x-checkbox--}}
{{--        name="terminos"--}}
{{--        label="Acepto los términos y condiciones"--}}
{{--        :checked="old('terminos')"--}}
{{--        :error="$errors->first('terminos')"--}}
{{--    />--}}

{{--    <x-date--}}
{{--        name="fecha_nacimiento"--}}
{{--        value="{{ old('fecha_nacimiento') }}"--}}
{{--        placeholder="Selecciona una fecha"--}}
{{--        required="true"--}}
{{--        :error="$errors->first('fecha_nacimiento')"--}}
{{--    />--}}

{{--    <x-input--}}
{{--        name="nombre"--}}
{{--        placeholder="Introduce tu nombre"--}}
{{--        required="true"--}}
{{--        value="{{ old('nombre') }}"--}}
{{--        :error="$errors->first('nombre')"--}}
{{--    />--}}

{{--    <x-label for="email" required>--}}
{{--        Correo electrónico--}}
{{--    </x-label>--}}

{{--    <x-input--}}
{{--        name="email"--}}
{{--        type="email"--}}
{{--        id="email"--}}
{{--        placeholder="ejemplo@correo.com"--}}
{{--        required--}}
{{--        :error="$errors->first('email')"--}}
{{--    />--}}

{{--    <x-label for="pais" required>País</x-label>--}}
{{--    <x-select--}}
{{--        name="pais"--}}
{{--        :options="['es' => 'España', 'mx' => 'México', 'ar' => 'Argentina']"--}}
{{--        :selected="old('pais')"--}}
{{--        :error="$errors->first('pais')"--}}
{{--    />--}}



    <!-- Footer -->
    @include('partials.footer')

