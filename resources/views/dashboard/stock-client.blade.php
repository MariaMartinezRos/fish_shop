@include('partials.nav-bar-client')

<!-- resources/views/components/product-list-all.blade.php -->
<div class="mg-10 pd-10">
.
</div>

<div id="product-list">
    @include('components.product-list-all', ['products' => $products])
</div>

@include('partials.footer')
