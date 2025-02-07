
@include('partials.nav-bar-client')

<x-slot name="header">
    <a href="{{ route('stock-client' ) }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <img src="{{ asset('images/go-back.png') }}" alt="{{ __('Go Back')}}" >
            {{ __('Go Back') }}
        </h2>
    </a>
</x-slot>

@include('components.product-show', ['product' => $product])

@include('partials.footer')
