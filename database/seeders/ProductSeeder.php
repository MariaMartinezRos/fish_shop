<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {

        if ($this->isDataAlreadyGiven()) {
            return;
        }
        Product::factory()->count(30)->released()->create();
    }

    private function isDataAlreadyGiven(): bool
    {
        return Product::exists();
    }

//    public static function getProduct(): Product
//    {
//        //get all products
//
//        $products = Product::all();
//
//        // get one product in random
//        $product = $products->random();
//
//        //        $product = $products->first();
//
//        if (! $product) {
//            throw new \Exception(__('No products found.'));
//        }
//
//        return $product;
//    }
}
