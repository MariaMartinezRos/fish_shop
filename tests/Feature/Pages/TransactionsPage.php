<?php

use App\Livewire\TransactionSearcher;
use Livewire\Livewire;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;

use function Pest\Laravel\get;

it('returns a successful response for transactions page', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->get(route('transaction'))
        ->assertOk()
        ->assertStatus(200);
});

it('cannot be accessed by guest', function () {
    // Act & Assert
    get(route('transaction'))
        ->assertRedirect(route('login'));
});

it('cannot be accessed by costumer', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 4]);
    $costumer = User::factory()->create(['role_id' => 'costumer']);

    // Act
    $this->actingAs($costumer)
        ->get(route('transaction'))
        ->assertRedirect(route('login'));
});

it('cannot be accessed by employee', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 3]);
    $employee = User::factory()->create(['role_id' => 'employee']);

    // Act
    $this->actingAs($employee)
        ->get(route('transaction'))
        ->assertRedirect(route('login'));
});

it('can be accessed by admin', function () {
    // Arrange
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->get(route('transaction'))
        ->assertOk()
        ->assertSeeText('Cliente');
});

it('displays transactions correctly', function () {
    // Act
    $this->artisan('db:seed');

    // Arrange
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Assert
    $this->actingAs($admin)
        ->get(route('transaction'))
        ->assertOk()
        ->assertSeeText('PESCADERIA BENITO ALHAMA')
        ->assertSeeText('PESCADERIA BENITO LIBRILLA');
});
