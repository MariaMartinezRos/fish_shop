<?php

use App\Models\Category;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;


it('renders select component with options', function () {
    $options = collect([
        (object)['id' => 1, 'display_name' => 'Option 1'],
        (object)['id' => 2, 'display_name' => 'Option 2'],
    ]);

    $view = $this->blade('<x-select name="test" :options="$options" />', ['options' => $options]);

    $view->assertSee('Option 1');
    $view->assertSee('Option 2');
});

it('renders select component with selected value', function () {
    $options = collect([
        (object)['id' => 1, 'display_name' => 'Option 1'],
        (object)['id' => 2, 'display_name' => 'Option 2'],
    ]);

    $view = $this->blade('<x-select name="test" :options="$options" selected="2" />', ['options' => $options]);

    $view->assertSee('Option 1');
    $view->assertSee('Option 2');
    $view->assertSee('selected');
});

it('renders select component with label', function () {
    $options = collect([
        (object)['id' => 1, 'display_name' => 'Option 1'],
        (object)['id' => 2, 'display_name' => 'Option 2'],
    ]);

    $view = $this->blade('<x-select name="test" :options="$options" label="Test Label" />', ['options' => $options]);

    $view->assertSee('Test Label');
    $view->assertSee('Option 1');
    $view->assertSee('Option 2');
});

it('renders select component with error state', function () {
    $options = collect([
        (object)['id' => 1, 'display_name' => 'Option 1'],
        (object)['id' => 2, 'display_name' => 'Option 2'],
    ]);

    $view = $this->blade('<x-select name="test" :options="$options" :error="true" />', ['options' => $options]);

    $view->assertSee('Option 1');
    $view->assertSee('Option 2');
    $view->assertSee('border-red-500');
});

it('renders select component with categories', function () {
    Category::factory()->create([
        'name' => 'test-category',
        'display_name' => 'Test Category',
    ]);

    $categories = Category::all();

    $view = $this->blade('<x-select name="category_id" :options="$categories" />', ['categories' => $categories]);

    $view->assertSee('Test Category');
});

it('renders select component with roles', function () {
    Role::factory()->create([
        'name' => 'test-role',
        'display_name' => 'Test Role',
    ]);

    $roles = Role::all();

    $view = $this->blade('<x-select name="role_id" :options="$roles" />', ['roles' => $roles]);

    $view->assertSee('Test Role');
});
