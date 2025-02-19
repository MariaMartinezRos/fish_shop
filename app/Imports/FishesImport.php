<?php

namespace App\Imports;

use App\Models\Fish;
use Maatwebsite\Excel\Concerns\ToModel;

class FishesImport implements ToModel
{
    public function model(array $row): Fish
    {
        return new Fish([
            'name' => $row[0],
            'image' => $row[1],
            'description' => $row[2],
        ]);
    }
}
