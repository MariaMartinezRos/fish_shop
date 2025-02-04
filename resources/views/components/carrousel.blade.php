@props(['carrousel'])

<div id="carouselExample" class="carousel slide absolute inset-0 z-0">
    <div class="carousel-inner">
        @foreach($carrousel as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ $image }}" class="d-block w-full object-cover h-full" alt="Carousel Image">
            </div>
        @endforeach
{{--        <div class="carousel-item active">--}}
{{--            <img src="{{ $carrousel['image1'] }}" class="d-block w-full object-cover h-full" alt="{{ $carrousel['image1'] }}">--}}
{{--        </div>--}}
{{--        <div class="carousel-item">--}}
{{--            <img src="{{ $carrousel['image2'] }}" class="d-block w-full object-cover h-full" alt="{{ $carrousel['image2'] }}">--}}
{{--        </div>--}}
{{--        <div class="carousel-item">--}}
{{--            <img src="{{ $carrousel['image3'] }}" class="d-block w-full object-cover h-full" alt="{{ $carrousel['image3'] }}">--}}
{{--        </div>--}}
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Agrega los links de Bootstrap en tu HTML -->
<link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js') }}"></script>

