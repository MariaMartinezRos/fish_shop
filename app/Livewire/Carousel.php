<?php

namespace App\Livewire;

use App\Jobs\FetchCarouselImages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Carousel extends Component
{
    public $images = [];

    public $currentIndex = 0;

//    private $imagePath = 'C:\\Users\\gines\\Herd\\fish_shop\\public\\images\\fishes';

    public function mount(): void
    {
        // Dispatch job to refresh image list
        FetchCarouselImages::dispatch();

        // Load images
        $this->images = Cache::get('carousel_images', $this->getImagesFromDirectory());
    }

    public function previous(): void
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        } else {
            $this->currentIndex = count($this->images) - 1;
        }
    }

    public function next(): void
    {
        if ($this->currentIndex < count($this->images) - 1) {
            $this->currentIndex++;
        } else {
            $this->currentIndex = 0;
        }
    }

    private function getImagesFromDirectory(): array
    {
        $files = File::files(public_path('images/fishes/'));

        return collect($files)->map(fn ($file) => asset('images/fishes/'.$file->getFilename()))->toArray();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('livewire.carousel');
    }
}
