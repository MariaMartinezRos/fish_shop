@if(isset($products) && count($products) > 0)
    @php
        $productList = [];
        foreach($products as $product) {
            $imagePath = 'images/'.$product->name.'.png';
            $productList[] = [
                'image' => file_exists(public_path($imagePath)) ? asset($imagePath) : asset('images/default.png'),
                'alt' => $product->name,
                'name' => $product->name,
                'description' => $product->description,
                'category' => asset('images/'.$product->category_id.'.png'),
                'price' => $product->price_per_kg,
                'id' => $product->id
            ];
        }
    @endphp
    <x-products-list :products="$productList" />
    {{ $products->links() }}
@else
    <p>{{ __("No products found.") }}</p>
@endif
