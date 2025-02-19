<?php

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

it('only returns transactions filtered by tvp', function () {
    // Arrange
    Transaction::factory(['tvp' => 'PESCADERIA BENITO ALHAMA'])->create();
    $role = Role::factory()->create(['id' => 1]);
    $admin = User::factory()->create(['role_id' => 'admin']);

    // Act
    $this->actingAs($admin)
        ->get(route('transaction'))
        ->assertOk()
        ->assertSeeText('PESCADERIA BENITO ALHAMA');

    //Act
    $this->assertDatabaseCount(Transaction::class, 0);

    //Act
    $this->artisan('db:seed');
    $this->assertDatabaseCount(Transaction::class, 40);

})->todo();
