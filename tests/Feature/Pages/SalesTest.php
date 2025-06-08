<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Smalot\PdfParser\Parser;

use function Pest\Laravel\get;

it('returns a successful response for sales page', function () {
    // Arrange
    loginAsAdmin();

    // Act
    $this->get('sales')
        ->assertOk()
        ->assertStatus(200);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get('sales')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $costumer = User::factory()->create(['role_id' => 4]);

    // Act
    $this->actingAs($costumer)
        ->get('sales')
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $employee = User::factory()->create(['role_id' => 2]);

    // Act
    $this->actingAs($employee)
        ->get('sales')
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    loginAsAdmin();

    // Act
    $this->get('sales')
        ->assertOk()
        ->assertSeeText('Cliente');
});

it('can download a soft deleted document', function () {
    // Arrange
    loginAsAdmin();
    $category = Category::factory()->create(['id' => 1]);
    $product = Product::factory()->create(['name' => 'Producto Prueba', 'category_id' => $category->id]);
    $product->delete();

    // Act
    $response = $this->post(route('soft-deletes'))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/pdf');

    $parser = new Parser;
    $pdf = $parser->parseContent($response->getContent());
    $text = $pdf->getText();

    // Assert
    expect($text)->toContain('Informe de Eliminaciones')
        ->and($text)->toContain('Products')
        ->and($text)->toContain($product->name);
});

it('calls the command when the button is pressed', function () {
    // Arrange
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('app:clean-log');
    // Act
    $this->post(route('run.command'));
    // Assert
    $this->artisan('view:clear')->assertExitCode(0);
    $this->artisan('cache:clear')->assertExitCode(0);
    $this->artisan('route:clear')->assertExitCode(0);
    $this->artisan('config:clear')->assertExitCode(0);
    $this->artisan('app:clean-log')->assertExitCode(0);
});
