<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public static array $products=[
        ['name' => 'lubina', 'category_id' => '0', 'price_per_kg' => '7.00', 'stock_kg' => '20', 'description' => 'Lubina de crianza en piscifactoría'],
        ['name' => 'salmón', 'category_id' => '1', 'price_per_kg' => '16.00', 'stock_kg' => '5.5', 'description' => 'Salmón de crianza en piscifactoría'],
        ['name' => 'bacalao', 'category_id' => '0', 'price_per_kg' => '8.00', 'stock_kg' => '3', 'description' => 'Bacalao salado'],
        ['name' => 'merluza', 'category_id' => '2', 'price_per_kg' => '10.00', 'stock_kg' => '8.00', 'description' => 'Merluza fresca'],
        ['name' => 'mejillones', 'category_id' => '3', 'price_per_kg' => '4.00', 'stock_kg' => '10.00', 'description' => 'Calamar fresco'],
    ];
        /**
         * Run the database seeds.
         */
    public function run(): void
    {
        foreach (self::$products as $product) {
            Product::create($product);
        }
    }

}
