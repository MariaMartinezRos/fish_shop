
<x-app-layout>
    <x-slot name="header">
        @include('components.go-back')
    </x-slot>
    @include('components.product-show', ['product' => $product])
</x-app-layout>
