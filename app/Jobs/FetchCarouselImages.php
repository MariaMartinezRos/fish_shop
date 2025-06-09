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
        try {
            \Log::info('Starting FetchCarouselImages job');

            $imagePath = public_path('images/fishes/');
            if (! File::exists($imagePath)) {
                session()->flash('error', __('Ooops, something happened...'));
            }

            $files = File::files($imagePath);
            $images = collect($files)
                ->map(fn ($file) => asset('images/fishes/'.$file->getFilename()))
                ->toArray();

            Cache::put('carousel_images', $images, now()->addMinutes(10));

        } catch (\Exception $e) {
            session()->flash('error', __('Failed to fetch carousel images: ').$e->getMessage());
        }
    }
}
