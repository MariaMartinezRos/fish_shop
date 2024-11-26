<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductsList extends Component
{
    public $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|string|\Closure|\Illuminate\View\View
    {
        return view('components.products-list');
    }
}
