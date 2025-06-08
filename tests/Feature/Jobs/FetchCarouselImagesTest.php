<?php

use App\Jobs\FetchCarouselImages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    $this->fishesDir = public_path('images/fishes');
//    File::deleteDirectory($this->fishesDir); // limpiar antes del test
});

//afterEach(function () {
//    File::deleteDirectory($this->fishesDir); // limpiar despues del test
//    Cache::forget('carousel_images');
//});

it('caches image URLs from the fish directory', function () {
    File::ensureDirectoryExists($this->fishesDir);

//    File::put($this->fishesDir . '/fish1.jpg', 'fake content');
//    File::put($this->fishesDir . '/fish2.png', 'fake content');

    (new FetchCarouselImages())->handle();

    $cached = Cache::get('carousel_images');

    expect($cached)->toBeArray()
        ->toHaveLength(12)
        ->each->toContain('images/fishes/');
});

it('flashes an error if job fails', function () {
    File::deleteDirectory(public_path('images/fishes'));

    $response = $this->get('/some-action');

    $response->assertSessionHas('error', 'Ooops, algo sucedió...');
})->todo();

it('caches an empty array if the directory is empty', function () {
    File::ensureDirectoryExists($this->fishesDir);

    (new FetchCarouselImages())->handle();

    $cached = Cache::get('carousel_images');

    expect($cached)->toBeArray()->toBeEmpty();
})->todo();

it('logs image count correctly', function () {
    File::ensureDirectoryExists($this->fishesDir);

    File::put($this->fishesDir . '/fish1.jpg', 'fake content');

    \Illuminate\Support\Facades\Log::shouldReceive('info')
        ->once()
        ->with('Starting FetchCarouselImages job');

    \Illuminate\Support\Facades\Log::shouldReceive('info')
        ->once()
        ->with('Carousel images fetched and cached successfully', \Mockery::subset([
            'count' => 1
        ]));

    (new FetchCarouselImages())->handle();
})->todo();



//<?php
//
//use App\Jobs\FetchCarouselImages;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\File;
//
//it('fetches and stores carousel images', function () {
//    Storage::fake('public');
//
//    $job = new FetchCarouselImages();
//    $job->handle();
//
//    $images = Storage::disk('public')->files('carousel');
//    expect($images)->not->toBeEmpty();
//});
//
//it('creates carousel directory if it does not exist', function () {
//    Storage::fake('public');
//
//    $job = new FetchCarouselImages();
//    $job->handle();
//
//    expect(Storage::disk('public')->exists('carousel'))->toBeTrue();
//});
//
//it('handles empty carousel directory', function () {
//    Storage::fake('public');
//    Storage::disk('public')->makeDirectory('carousel');
//
//    $job = new FetchCarouselImages();
//    $job->handle();
//
//    $images = Storage::disk('public')->files('carousel');
//    expect($images)->not->toBeEmpty();
//});
//
//it('handles existing carousel images', function () {
//    Storage::fake('public');
//    Storage::disk('public')->makeDirectory('carousel');
//
//    // Create some existing images
//    Storage::disk('public')->put('carousel/image1.jpg', 'dummy content');
//    Storage::disk('public')->put('carousel/image2.jpg', 'dummy content');
//
//    $job = new FetchCarouselImages();
//    $job->handle();
//
//    $images = Storage::disk('public')->files('carousel');
//    expect($images)->not->toBeEmpty();
//});
//
//it('validates image files', function () {
//    Storage::fake('public');
//    Storage::disk('public')->makeDirectory('carousel');
//
//    $job = new FetchCarouselImages();
//    $job->handle();
//
//    $images = Storage::disk('public')->files('carousel');
//    foreach ($images as $image) {
//        expect(File::extension($image))->toBeIn(['jpg', 'jpeg', 'png', 'gif']);
//    }
//});
//
//it('handles failed image downloads', function () {
//    Storage::fake('public');
//    Storage::disk('public')->makeDirectory('carousel');
//
//    $job = new FetchCarouselImages();
//    $job->handle();
//
//    $images = Storage::disk('public')->files('carousel');
//    expect($images)->not->toBeEmpty();
//});
//
//it('maintains image quality', function () {
//    Storage::fake('public');
//    Storage::disk('public')->makeDirectory('carousel');
//
//    $job = new FetchCarouselImages();
//    $job->handle();
//
//    $images = Storage::disk('public')->files('carousel');
//    foreach ($images as $image) {
//        $size = Storage::disk('public')->size($image);
//        expect($size)->toBeGreaterThan(0);
//    }
//});
