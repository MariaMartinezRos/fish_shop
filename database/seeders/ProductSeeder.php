<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        $categories = Category::all();
        $products = [
            ['name' => 'lubina', 'category_id' => $categories[0]->id, 'price_per_kg' => '7.00', 'stock_kg' => '20', 'description' => 'Lubina de crianza en piscifactoría'],
            ['name' => 'salmón', 'category_id' => $categories[1]->id, 'price_per_kg' => '16.00', 'stock_kg' => '5.5', 'description' => 'Salmón de crianza en piscifactoría'],
            ['name' => 'bacalao', 'category_id' => $categories[0]->id, 'price_per_kg' => '8.00', 'stock_kg' => '3', 'description' => 'Bacalao salado'],
            ['name' => 'merluza', 'category_id' => $categories[2]->id, 'price_per_kg' => '10.00', 'stock_kg' => '8.00', 'description' => 'Merluza fresca'],
            ['name' => 'mejillones', 'category_id' => $categories[3]->id, 'price_per_kg' => '4.00', 'stock_kg' => '10.00', 'description' => 'Mejillones frescos'],
            ['name' => 'calamar', 'category_id' => $categories[3]->id, 'price_per_kg' => '12.00', 'stock_kg' => '6.5', 'description' => 'Calamar fresco'],
            ['name' => 'atún', 'category_id' => $categories[1]->id, 'price_per_kg' => '18.00', 'stock_kg' => '7.00', 'description' => 'Atún rojo de captura sostenible'],
            ['name' => 'trucha', 'category_id' => $categories[0]->id, 'price_per_kg' => '9.50', 'stock_kg' => '11.00', 'description' => 'Trucha fresca'],
            ['name' => 'rodaballo', 'category_id' => $categories[0]->id, 'price_per_kg' => '25.00', 'stock_kg' => '4.00', 'description' => 'Rodaballo de acuicultura'],
            ['name' => 'rape', 'category_id' => $categories[2]->id, 'price_per_kg' => '20.00', 'stock_kg' => '3.5', 'description' => 'Rape fresco'],
            ['name' => 'jurel', 'category_id' => $categories[1]->id, 'price_per_kg' => '7.50', 'stock_kg' => '12.00', 'description' => 'Jurel fresco'],
            ['name' => 'caballa', 'category_id' => $categories[1]->id, 'price_per_kg' => '5.00', 'stock_kg' => '15.00', 'description' => 'Caballa fresca'],
            ['name' => 'pez limón', 'category_id' => $categories[0]->id, 'price_per_kg' => '12.50', 'stock_kg' => '9.00', 'description' => 'Pez limón fresco'],
            ['name' => 'pez espada', 'category_id' => $categories[2]->id, 'price_per_kg' => '28.00', 'stock_kg' => '3.00', 'description' => 'Pez espada fresco'],
            ['name' => 'langosta', 'category_id' => $categories[3]->id, 'price_per_kg' => '35.00', 'stock_kg' => '2.00', 'description' => 'Langosta fresca'],
            ['name' => 'almejas', 'category_id' => $categories[3]->id, 'price_per_kg' => '14.00', 'stock_kg' => '6.00', 'description' => 'Almejas frescas'],
            ['name' => 'ostra', 'category_id' => $categories[3]->id, 'price_per_kg' => '40.00', 'stock_kg' => '1.00', 'description' => 'Ostras frescas'],
            ['name' => 'camarón', 'category_id' => $categories[3]->id, 'price_per_kg' => '25.00', 'stock_kg' => '8.00', 'description' => 'Camarón fresco'],
            ['name' => 'pargo', 'category_id' => $categories[0]->id, 'price_per_kg' => '18.50', 'stock_kg' => '5.00', 'description' => 'Pargo fresco'],
            ['name' => 'tilapia', 'category_id' => $categories[0]->id, 'price_per_kg' => '6.50', 'stock_kg' => '20.00', 'description' => 'Tilapia de cultivo'],
            ['name' => 'sardinas', 'category_id' => $categories[1]->id, 'price_per_kg' => '4.50', 'stock_kg' => '10.00', 'description' => 'Sardinas congeladas'],
            ['name' => 'preparado', 'category_id' => $categories[1]->id, 'price_per_kg' => '10.00', 'stock_kg' => '8.00', 'description' => 'Preaparado para paella'],
            ['name' => 'pulpo', 'category_id' => $categories[2]->id, 'price_per_kg' => '22.00', 'stock_kg' => '4.00', 'description' => 'Pulpo fresco'],
            ['name' => 'sepia', 'category_id' => $categories[2]->id, 'price_per_kg' => '15.00', 'stock_kg' => '6.00', 'description' => 'Sepia fresca'],
            ['name' => 'gambas', 'category_id' => $categories[3]->id, 'price_per_kg' => '20.00', 'stock_kg' => '5.00', 'description' => 'Gambas frescas'],
            ['name' => 'cigalas', 'category_id' => $categories[3]->id, 'price_per_kg' => '30.00', 'stock_kg' => '3.00', 'description' => 'Cigalas frescas'],
            ['name' => 'bogavante', 'category_id' => $categories[3]->id, 'price_per_kg' => '50.00', 'stock_kg' => '1.00', 'description' => 'Bogavante fresco'],
            ['name' => 'vieiras', 'category_id' => $categories[3]->id, 'price_per_kg' => '35.00', 'stock_kg' => '2.00', 'description' => 'Vieiras frescas'],
            ['name' => 'cangrejo', 'category_id' => $categories[3]->id, 'price_per_kg' => '25.00', 'stock_kg' => '4.00', 'description' => 'Cangrejo fresco'],
            ['name' => 'carabineros', 'category_id' => $categories[3]->id, 'price_per_kg' => '40.00', 'stock_kg' => '1.00', 'description' => 'Carabineros frescos'],
            ['name' => 'salmonete', 'category_id' => $categories[0]->id, 'price_per_kg' => '14.00', 'stock_kg' => '7.00', 'description' => 'Salmonete frescos']


        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
