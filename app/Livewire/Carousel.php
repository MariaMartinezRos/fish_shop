<?php

namespace App\Livewire;

use Livewire\Component;
use App\Jobs\FetchCarouselImages;
use App\Jobs\ChangeCarouselImage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

//class Carousel extends Component
//{
//    // Path to the directory
//    private string $imagePath = 'images/fishes'; // relative path from public
//
//    // Property to store images
//    public $images = [];
//    public $currentImageIndex = 0;
//
//    // Mount method to load images
//    public function mount(): void
//    {
//        // Get all images from the directory
//        $this->images = collect(Storage::files($this->imagePath))
//            ->filter(fn($file) => in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
//            ->map(fn($file) => Storage::url($file))
//            ->toArray();
//    }
//
//    // Method to update the current image index for the carousel
//    public function nextImage(): void
//    {
//        $this->currentImageIndex = ($this->currentImageIndex + 1) % count($this->images);
//    }
//
//    // Livewire render method
//    public function render()
//    {
//        return view('livewire.carousel');
//    }
//}



//class Carousel extends Component
//{
//    public $images = [];
//    public $currentIndex = 0;
//
//    public function mount(): void
//    {
//        // Dispatch job to refresh image list
//        FetchCarouselImages::dispatch();
//
//        // Load images from cache or directory
//        $this->images = Cache::get('carousel_images', $this->getImagesFromDirectory());
//
//        // Listen for job completion or event and trigger image change
//        ChangeCarouselImage::dispatch($this);  // Make sure you handle this logic properly in the job.
//    }
//
//    private function getImagesFromDirectory(): array
//    {
//        $files = File::files($this->imagePath);
//        return collect($files)->map(fn($file) => asset('images/fishes/' . $file->getFilename()))->toArray();
//    }
//
//    // This method will be triggered by the event
//    public function changeImage(): void
//    {
//        // Cycle through images
//        $this->currentIndex = ($this->currentIndex + 1) % count($this->images);
//    }
//
//    // Listen for the event to trigger the image change
//    protected $listeners = ['changeImageEvent' => 'changeImage'];
//
//    public function render()
//    {
//        return view('livewire.carousel');
//    }
//}


//namespace App\Livewire;
//
//use Livewire\Component;
//use App\Jobs\FetchCarouselImages;
//use App\Jobs\ChangeCarouselImage;
//use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\File;
//
///**
// * @method emit(string $string)
// */
//class Carousel extends Component
//{
//    public $images = [];
//    public $currentIndex = 0;  // Track the current image index
//
//    private $imagePath = 'C:\\Users\\gines\\Herd\\fish_shop\\public\\images\\fishes';
//
//    public function mount(): void
//    {
//        // Dispatch job to refresh image list
//        FetchCarouselImages::dispatch();
//
//        // Load images from cache or directory
//        $this->images = Cache::get('carousel_images', $this->getImagesFromDirectory());
//
//        // Dispatch a job to change the image every 3 seconds
////        ChangeCarouselImage::dispatch()->onQueue('carousel');
//        ChangeCarouselImage::dispatch($this);
//
//    }
//
//    // Get images from directory or cache
//    private function getImagesFromDirectory(): array
//    {
//        $files = File::files($this->imagePath);
//        return collect($files)->map(fn($file) => asset('images/fishes/' . $file->getFilename()))->toArray();
//    }
//
//    // This method will be triggered by the event
//    public function changeImage(): void
//    {
//        // Cycle through images
//        $this->currentIndex = ($this->currentIndex + 1) % count($this->images);
//    }
//
//    // Listen for the event to trigger the image change
//    protected $listeners = ['changeImageEvent' => 'changeImage'];
//
//    public function render()
//    {
//        return view('livewire.carousel');
//    }
//}


//namespace App\Livewire;
//
//use Livewire\Component;
//use App\Jobs\FetchCarouselImages;
//use App\Jobs\ChangeCarouselImage;
//use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\File;
//
///**
// * @method static find(int $int)
// */
//class Carousel extends Component
//{
//    public $images = [];
//    public $currentIndex = 0;  // Track the current image index
//
//    private $imagePath = 'C:\\Users\\gines\\Herd\\fish_shop\\public\\images\\fishes';
//
//    public function mount(): void
//    {
//        // Dispatch job to refresh image list
//        FetchCarouselImages::dispatch();
//
//        // Load images from cache or directory
//        $this->images = Cache::get('carousel_images', $this->getImagesFromDirectory());
//
//        // Dispatch a job to change the image every 3 seconds
//        ChangeCarouselImage::dispatch()->onQueue('carousel');
//    }
//
//    // Get images from directory or cache
//    private function getImagesFromDirectory(): array
//    {
//        $files = File::files($this->imagePath);
//        return collect($files)->map(fn($file) => asset('images/fishes/' . $file->getFilename()))->toArray();
//    }
//
//    // Change the image index (to be called periodically by the job)
//    public function changeImage()
//    {
//        // Cycle through images
//        $this->currentIndex = ($this->currentIndex + 1) % count($this->images);
//
//        // Dispatch the job again to continue the cycle
//        ChangeCarouselImage::dispatch()->delay(now()->addSeconds(3)); // Wait 3 seconds
//    }
//
//    public function render()
//    {
//        return view('livewire.carousel');
//    }
//}

//namespace App\Livewire;
//
//use Illuminate\Contracts\View\Factory;
//use Illuminate\Foundation\Application;
//use Illuminate\View\View;
//use Livewire\Component;
//use App\Jobs\FetchCarouselImages;
//use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\File;
//
//class Carousel extends Component
//{
//    public $images = [];
//    public $currentIndex = 0;  // Track the current image index
//    private $imagePath = 'C:\\Users\\gines\\Herd\\fish_shop\\public\\images\\fishes';
//
//    public function mount(): void
//    {
//        // Dispatch job to refresh image list
//        FetchCarouselImages::dispatch();
//
//        // Load images from cache or directory
//        $this->images = Cache::get('carousel_images', $this->getImagesFromDirectory());
//
//        // Start automatic image change
//        $this->startImageAutoChange();
//    }
//
//    public function startImageAutoChange(): void
//    {
//        // Dispatch a background job (or use a queued task) to automatically change the image
//        $this->dispatchBrowserEvent('image-change', ['interval' => 3000]);  // Change every 3 seconds
//    }
//
//    // Automatically change the current image index every few seconds
//    public function changeImage(): void
//    {
//        $this->currentIndex = ($this->currentIndex + 1) % count($this->images);
//
//        // After the image change, dispatch another job or call `changeImage` again
//        $this->dispatchAfterResponse(function () {
//            $this->changeImage(); // Call the method again after a short delay (simulate a loop)
//        });
//    }
//
//    private function getImagesFromDirectory(): array
//    {
//        $files = File::files($this->imagePath);
//        return collect($files)->map(fn($file) => asset('images/fishes/' . $file->getFilename()))->toArray();
//    }
//
//    public function render(): \Illuminate\Contracts\View\View|Application|Factory|View
//    {
//        return view('livewire.carousel');
//    }
//
//}


//namespace App\Livewire;
//
//use Illuminate\Contracts\View\Factory;
//use Illuminate\Foundation\Application;
//use Illuminate\View\View;
//use Livewire\Component;
//use App\Jobs\FetchCarouselImages;
//use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\File;
//
class Carousel extends Component
{
    public $images = [];
    public $currentIndex = 0;  // Track the current image index

    private $imagePath = 'C:\\Users\\gines\\Herd\\fish_shop\\public\\images\\fishes';

    public function mount(): void
    {
        // Dispatch job to refresh image list
        FetchCarouselImages::dispatch();

        // Load images from cache or directory
        $this->images = Cache::get('carousel_images', $this->getImagesFromDirectory());
    }

    // Navigate to the previous image
    public function previous()
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        } else {
            $this->currentIndex = count($this->images) - 1; // Go to the last image
        }
    }

    // Navigate to the next image
    public function next()
    {
        if ($this->currentIndex < count($this->images) - 1) {
            $this->currentIndex++;
        } else {
            $this->currentIndex = 0; // Go to the first image
        }
    }

    private function getImagesFromDirectory(): array
    {
        $files = File::files($this->imagePath);
        return collect($files)->map(fn($file) => asset('images/fishes/' . $file->getFilename()))->toArray();
    }

    public function render(): \Illuminate\Contracts\View\View|Application|Factory|View
    {
        return view('livewire.carousel');
    }
}

//
//namespace App\Livewire;
//
//use Illuminate\Contracts\View\Factory;
//use Illuminate\Foundation\Application;
//use Illuminate\View\View;
//use Livewire\Component;
//use App\Jobs\FetchCarouselImages;
//use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\File;
//
//class Carousel extends Component
//{
//    public $images = [];
//    private $imagePath = 'C:\\Users\\gines\\Herd\\fish_shop\\public\\images\\fishes';
//
//    public $currentIndex = 0;
//
//
//    public function mount(): void
//    {
//        // Dispatch job to refresh image list
//        FetchCarouselImages::dispatch();
//
//        // Load images from cache or directory
//        $this->images = Cache::get('carousel_images', $this->getImagesFromDirectory());
//    }
//
//    private function getImagesFromDirectory(): array
//    {
//        $files = File::files($this->imagePath);
//        return collect($files)->map(fn($file) => asset('images/fishes/' . $file->getFilename()))->toArray();
//    }
//
//    public function previous(): void
//    {
//        $this->currentIndex = ($this->currentIndex - 1 + count($this->images)) % count($this->images);
//    }
//
//    public function next(): void
//    {
//        $this->currentIndex = ($this->currentIndex + 1) % count($this->images);
//    }
//
//
//    public function render(): \Illuminate\Contracts\View\View|Application|Factory|View
//    {
//        return view('livewire.carousel');
//    }
//}

