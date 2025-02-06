<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Model|Product|null
     */
    public function model(array $row): Model|Product|null
    {
        // Check if category_id exists in the categories table
        if (!Category::find($row[1])) {
            return null; // Skip the row if category_id does not exist
        }

        // Check if product with the same name already exists
        $existingProduct = Product::where('name', $row[0])->first();
        if ($existingProduct) {
            // Optionally update the existing product
            $existingProduct->update([
                'category_id'  => (int) $row[1],
                'price_per_kg' => (int) $row[2],
                'stock_kg'     => (int) $row[3],
                'description'  => $row[4],
            ]);
            return null; // Skip the row to avoid duplicate entry
        }

        return new Product([
            'name'         => $row[0],
            'category_id'  => (int) $row[1],
            'price_per_kg' => (int) $row[2],
            'stock_kg'     => (int) $row[3],
            'description'  => $row[4],
        ]);
    }
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.1' => 'exists:categories,id', // Validate that category_id exists in categories table
        ];
    }
}
