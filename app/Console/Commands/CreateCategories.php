<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class CreateCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create predefined categories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Predefined categories
        $categories = [
            ['name' => 'fresh'],
            ['name' => 'frozen'],
            ['name' => 'cut'],
            ['name' => 'seafood'],
            ['name' => 'other'],
        ];

        foreach ($categories as $categoryData) {
            if (!Category::where('name', $categoryData['name'])->exists()) {
                Category::create($categoryData);
                $this->info('Category "' . $categoryData['name'] . '" created successfully!');
            } else {
                $this->error('Category "' . $categoryData['name'] . '" already exists.');
            }
        }
    }
}


