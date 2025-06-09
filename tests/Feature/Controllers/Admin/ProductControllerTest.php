<?php

use App\Events\ProductAdded;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

beforeEach(function () {
    Event::fake();
    Storage::fake('local');
    $this->admin = User::factory()->create(['role_id' => 1]);
    $this->actingAs($this->admin);
});

it('displays list of products', function () {
    $category = Category::factory()->create();
    $products = Product::factory()->count(3)->create([
        'category_id' => $category->id,
    ]);

    $response = $this->get(route('stock'));

    $response->assertStatus(200)
        ->assertViewIs('stock')
        ->assertViewHas('products');
});

it('shows individual product', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $category->id,
    ]);

    $response = $this->get(route('products.show', $product->id));

    $response->assertStatus(200)
        ->assertViewIs('products.show')
        ->assertViewHas('product', $product);
});

it('imports products from excel file', function () {
    Excel::fake();

    $file = UploadedFile::fake()->create('products.xlsx', 100);

    $response = $this->post(route('products.import'), [
        'file' => $file,
    ]);

    Excel::assertImported('products.xlsx');
    $response->assertRedirect(route('stock'))
        ->assertSessionHas('success');
});

it('shows create product form', function () {
    $categories = Category::factory()->count(3)->create();

    $response = $this->get(route('products.create'));

    $response->assertStatus(200)
        ->assertViewIs('products.create')
        ->assertViewHas('categories');
});

it('stores new product', function () {
    $productData = [
        'name' => 'Test Product',
        'description' => 'Test Description',
        'price' => 99.99,
        'stock' => 100,
        'category_id' => Category::factory()->create()->id,
    ];

    $response = $this->post(route('products.store'), $productData);

    $this->assertDatabaseHas('products', $productData);
    Event::assertDispatched(ProductAdded::class);
    $response->assertRedirect()
        ->assertSessionHas('success');
})->todo();

it('shows edit product form', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $category->id,
    ]);

    $response = $this->get(route('products.edit', $product));

    $response->assertStatus(200)
        ->assertViewIs('products.edit')
        ->assertViewHas('product', $product);
});

it('updates product', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $category->id,
    ]);

    $updateData = [
        'name' => 'Updated Product',
        'description' => 'Updated Description',
        'price' => 149.99,
        'stock' => 50,
        'category_id' => $product->category_id,
    ];

    $response = $this->put(route('products.update', $product), $updateData);

    $this->assertDatabaseHas('products', $updateData);
    $response->assertRedirect()
        ->assertSessionHas('success');
})->todo();

it('soft deletes product', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $category->id,
    ]);

    $response = $this->delete(route('products.destroy', $product));

    $this->assertDatabaseHas('products', ['id' => $product->id, 'deleted_at' => now()]);
    $response->assertRedirect(route('stock'))
        ->assertSessionHas('success');
});

it('deletes all products', function () {
    $category = Category::factory()->create();
    $products = Product::factory()->count(3)->create([
        'category_id' => $category->id,
    ]);

    $response = $this->delete(route('products.delete-all'));

    $this->assertDatabaseCount('products', 0);
    $response->assertRedirect(route('products.index'))
        ->assertSessionHas('success');
})->todo();

it('validates required fields when creating product', function () {
    $response = $this->post(route('products.store'), []);

    $response->assertSessionHasErrors(['name', 'price', 'stock', 'category_id']);
})->todo();

it('validates required fields when updating product', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $category->id,
    ]);

    $response = $this->put(route('products.update', $product), []);

    $response->assertSessionHasErrors(['name', 'price', 'stock', 'category_id']);
})->todo();
