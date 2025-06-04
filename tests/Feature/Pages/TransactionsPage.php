<?php

use App\Livewire\TransactionSearcher;
use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;

//
// it('returns a successful response for transactions page', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 1]);
//    $admin = User::factory()->create(['role_id' => 'admin']);
//
//    // Act
//    $this->actingAs($admin)
//        ->get(route('transaction'))
//        ->assertOk()
//        ->assertStatus(200);
// });
//
// it('cannot be accessed by guest', function () {
//    // Act & Assert
//    get(route('transaction'))
//        ->assertRedirect(route('login'));
// });
//
// it('cannot be accessed by costumer', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 4]);
//    $costumer = User::factory()->create(['role_id' => 'costumer']);
//
//    // Act
//    $this->actingAs($costumer)
//        ->get(route('transaction'))
//        ->assertRedirect(route('login'));
// });
//
// it('cannot be accessed by employee', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 'employee']);
//
//    // Act
//    $this->actingAs($employee)
//        ->get(route('transaction'))
//        ->assertRedirect(route('login'));
// });
//
// it('can be accessed by admin', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 1]);
//    $admin = User::factory()->create(['role_id' => 'admin']);
//
//    // Act
//    $this->actingAs($admin)
//        ->get(route('transaction'))
//        ->assertOk()
//        ->assertSeeText('Cliente');
// });
//
// it('displays transactions correctly', function () {
//    // Act
//    $this->artisan('db:seed');
//
//    // Arrange
//    $admin = User::factory()->create(['role_id' => 'admin']);
//
//    // Assert
//    $this->actingAs($admin)
//        ->get(route('transaction'))
//        ->assertOk()
//        ->assertSeeText('PESCADERIA BENITO ALHAMA')
//        ->assertSeeText('PESCADERIA BENITO LIBRILLA');
// });
//
// it('renders the transaction component correctly', function () {
//    // Arrange
//    $admin = User::factory()->create(['role_id' => 'admin']);
//
//    // Act
//    $response = $this->actingAs($admin)
//        ->get(route('transaction'));
//
//    // Assert
//    $response->assertSeeLivewire('transaction-searcher');
// });
//
// it('searches transactions correctly', function () {
//    // Arrange: Create transactions with different tpv values
//    $this->artisan('db:seed');
//
//    // Act: Render the component with a specific tpv value
//    $component = Livewire::test(TransactionSearcher::class)
//        ->set('tpv', 'PESCADERIA BENITO ALHAMA');
//
//    // Assert: Check if the component filters transactions correctly
//    $component->assertViewHas('transactions', function ($transactions) {
//        return $transactions->count() === 20;
//    });
// });
