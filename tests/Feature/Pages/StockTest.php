<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;


it('returns a successful response for stock page', function () {
    // Arrange
    loginAsAdmin();

    // Act
    $this->get(route('stock'))
        ->assertOk();
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get(route('stock'))
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $customerRole = Role::factory()->create(['name' => 'customer']);
    $customer = User::factory()->create();
    $customer->role_id = $customerRole->id;
    $customer->save();

    // Act
    $this->actingAs($customer)
        ->get(route('stock'))
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $employeeRole = Role::factory()->create(['name' => 'employee']);
    $employee = User::factory()->create();
    $employee->role_id = $employeeRole->id;
    $employee->save();

    // Act
    $this->actingAs($employee)
        ->get(route('stock'))
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $this->actingAs($admin)
        ->get(route('stock'))
        ->assertOk()
        ->assertSeeText('Cliente');
});

it('shows stock overview', function () {
    // Arrange
    $category = Category::factory()->create();
    $firstProduct = Product::factory()->create(['category_id' => $category->id]);
    $secondProduct = Product::factory()->create(['category_id' => $category->id]);
    $thirdProduct = Product::factory()->create(['category_id' => $category->id]);

    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $this->actingAs($admin)
        ->get(route('stock'))
        ->assertSeeText([
            $firstProduct->name,
            $secondProduct->name,
            $thirdProduct->name,
        ]);
});

it('includes logout if logged in', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $this->actingAs($admin)
        ->get(route('stock'))
        ->assertOk()
        ->assertSee('Finalizar sesión')
        ->assertSee(route('logout'));
});

it('includes product links', function () {
    // Arrange
    $category = Category::factory()->create();
    $firstProduct = Product::factory()->create(['category_id' => $category->id]);
    $secondProduct = Product::factory()->create(['category_id' => $category->id]);
    $thirdProduct = Product::factory()->create(['category_id' => $category->id]);

    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $this->actingAs($admin)
        ->get(route('products.index'))
        ->assertOk()
        ->assertSee([
            route('products.show', $firstProduct),
            route('products.show', $secondProduct),
            route('products.show', $thirdProduct),
        ]);
});

it('shows a message when no products are available', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $this->actingAs($admin)
        ->get(route('stock'))
        ->assertOk()
        ->assertSee('No se encontraron productos.');
});

it('paginates the stock list', function () {
    // Arrange
    $category = Category::factory()->create();
    Product::factory()->count(50)->create(['category_id' => $category->id]);
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $this->actingAs($admin)
        ->get(route('products.index'))
        ->assertOk()
        ->assertSee('Anterior')
        ->assertSee('Siguiente');
});

it('searches products by name', function () {
    // Arrange
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id, 'name' => 'UniqueProductName']);
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $this->actingAs($admin)
        ->get(route('products.index', ['search' => 'UniqueProductName']))
        ->assertOk()
        ->assertSee($product->name);
});

it('can create a product successfully', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();
    $category = Category::factory()->create();

    // Act
    $this->actingAs($admin)
        ->post('products', [
            'name' => 'Salmon noruego',
            'category_id' => $category->id,
            'price_per_kg' => 10.5,
            'stock_kg' => 100,
            'description' => 'Salmon noruego de la mejor calidad',
        ])
        ->assertRedirect('products/1')
        ->assertSessionHas('success', 'Product created successfully.');

    // Assert
    $this->assertDatabaseHas('products', [
        'name' => 'Salmon noruego',
        'category_id' => $category->id,
        'price_per_kg' => 10.5,
        'stock_kg' => 100,
        'description' => 'Salmon noruego de la mejor calidad',
    ]);
});

it('can edit a product successfully', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();
    $category = Category::factory()->create();

    $product = Product::factory()->create(['name' => 'Salmon noruego', 'category_id' => $category->id]);

    // Act
    $this->actingAs($admin)
        ->put(route('products.update', $product), [
            'name' => 'Salmon noruego REBAJADO',
            'category_id' => $category->id,
            'price_per_kg' => 10.5,
            'stock_kg' => 100,
            'description' => 'Salmon noruego de la mejor calidad',
        ])
        ->assertRedirect('products/1')
        ->assertSessionHas('success', 'Product updated successfully');

    // Assert
    $this->assertDatabaseHas('products', [
        'name' => 'Salmon noruego REBAJADO',
        'category_id' => $category->id,
        'price_per_kg' => 10.5,
        'stock_kg' => 100,
        'description' => 'Salmon noruego de la mejor calidad',
    ]);
});

it('can delete a product successfully', function () {
    // Arrange
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();
    $category = Category::factory()->create();

    $product = Product::factory()->create(['name' => 'Salmon noruego', 'category_id' => $category->id]);

    // Act && Assert
    $this->actingAs($admin)
        ->delete("products/{$product->id}")
        ->assertRedirect('stock')
        ->assertSessionHas('success', 'Product deleted successfully');
});

it('can be downloaded as a PDF file', function () {
    // Arrange
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);
    $adminRole = Role::factory()->create(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->role_id = $adminRole->id;
    $admin->save();

    // Act
    $response = $this->actingAs($admin)
        ->get(route('products.pdf'));

    // Assert
    $response->assertOk()
        ->assertHeader('Content-Type', 'application/pdf')
        ->assertHeader('Content-Disposition', 'attachment; filename=products.pdf');
});
