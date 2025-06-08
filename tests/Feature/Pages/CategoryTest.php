<?php

use App\Livewire\CategoryManager;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

// beforeEach(function () {
//    $this->role_admin = \App\Models\Role::factory()->create(['name' => 'admin']);
//    $this->role_customer = \App\Models\Role::factory()->create(['name' => 'customer', 'id' => 4]);
//
//    $this->admin = User::factory()->create(['role_id' => $this->role_admin->id]);
//    $this->client = User::factory()->create(['role_id' => $this->role_customer->id]);
//
// });

it('returns a successful response for category page', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Act
    $this->actingAs($admin)
        ->get('category')
        ->assertOk()
        ->assertStatus(200);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('category')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $costumer = User::factory()->create(['role_id' => 4]);

    // Act
    $this->actingAs($costumer)
        ->get('category')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $employee = User::factory()->create(['role_id' => 3]);

    // Act
    $this->actingAs($employee)
        ->get('category')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Act
    $this->actingAs($admin)
        ->get('category')
        ->assertOk()
        ->assertSeeText('Cliente');
});

it('renders the category manager component', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->assertViewIs('livewire.category-manager');
});

it('displays a list of categories', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    $categories = Category::factory()->count(3)->create();

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->assertSee($categories[0]->name)
        ->assertSee($categories[1]->name)
        ->assertSee($categories[2]->name);
});

it('shows a message when no categories are available', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->assertSee('No se encontraron categorías.');
});

it('can create a new category', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->set('name', 'test-category')
        ->set('display_name', 'Test Category')
        ->set('description', 'Test Description')
        ->call('store')
        ->assertSee('Categoría creada exitosamente.');

    $this->assertDatabaseHas('categories', [
        'name' => 'test-category',
        'display_name' => 'Test Category',
        'description' => 'Test Description',
    ]);
});

it('can edit an existing category', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    $category = Category::factory()->create();

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->call('edit', $category)
        ->set('name', 'updated-category')
        ->set('display_name', 'Updated Category')
        ->set('description', 'Updated Description')
        ->call('update')
        ->assertSee('Categoría actualizada exitosamente.');

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'updated-category',
        'display_name' => 'Updated Category',
        'description' => 'Updated Description',
    ]);
});

it('can delete a category', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    $category = Category::factory()->create(['id' => 9]);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->call('delete', $category->id)
        ->assertSee('Categoría eliminada correctamente');

    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
});

it('cannot delete a category that is in use by products', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    $category = Category::factory()->create();
    Product::factory()->create(['category_id' => $category->id]);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->call('delete', $category->id)
        ->assertSee('La categoría no puede ser eliminada porque está siendo utilizada por uno o más productos. Por favor, elimina la categoría de todos los productos o elimina los productos primero.');

    $this->assertDatabaseHas('categories', ['id' => $category->id]);
});

it('validates required fields when creating a category', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->set('name', '')
        ->set('display_name', '')
        ->set('description', '')
        ->call('store')
        ->assertHasErrors(['name']);
});

it('validates unique category names', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    Category::factory()->create(['name' => 'existing-category']);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->set('name', 'existing-category')
        ->set('display_name', 'Test Category')
        ->set('description', 'Test Description')
        ->call('store')
        ->assertHasErrors(['name']);
});

it('can search categories', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    Category::factory()->create(['name' => 'test-category']);
    Category::factory()->create(['name' => 'other-category']);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->set('search', 'test')
        ->assertSee('test-category')
        ->assertDontSee('other-category');
});

it('paginates categories', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    Category::factory()->count(15)->create();

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->assertSee('Anterior')
        ->assertSee('Siguiente');
});

it('shows create form when clicking add category button', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->call('create')
        ->assertSet('creating', true)
        ->assertSet('editing', false);
});

it('shows edit form when clicking edit button', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    $category = Category::factory()->create();

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(CategoryManager::class)
        ->call('edit', $category)
        ->assertSet('editing', true)
        ->assertSet('creating', false)
        ->assertSet('categoryId', $category->id)
        ->assertSet('name', $category->name)
        ->assertSet('display_name', $category->display_name)
        ->assertSet('description', $category->description);
});
