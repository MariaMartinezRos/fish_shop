<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class FetchCarouselImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $files = File::files(public_path('images/fishes/'));
        $images = collect($files)->map(fn ($file) => asset('images/fishes/'.$file->getFilename()))->toArray();

        Cache::put('carousel_images', $images, now()->addMinutes(10));
    }
}
