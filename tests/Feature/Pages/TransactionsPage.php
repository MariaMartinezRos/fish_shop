<?php

use App\Livewire\TransactionSearcher;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Livewire;

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

it('filters transactions to show only todays transactions when checkbox is checked', function () {
    // Arrange
    $admin = User::factory()->create(['role_id' => 1]);

    // Create a transaction from today
    $todayTransaction = Transaction::create([
        'tpv' => 'PESCADERIA BENITO ALHAMA',
        'serial_number' => 'SN-001',
        'terminal_number' => 'TN-001',
        'operation' => 'VENTA',
        'amount' => 100.50,
        'card_number' => '1234567890123456',
        'date_time' => now(),
        'transaction_number' => 'TXN-001',
        'sale_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Create a transaction from yesterday
    $yesterdayTransaction = Transaction::create([
        'tpv' => 'PESCADERIA BENITO LIBRILLA',
        'serial_number' => 'SN-002',
        'terminal_number' => 'TN-002',
        'operation' => 'VENTA',
        'amount' => 200.75,
        'card_number' => '2345678901234567',
        'date_time' => now()->subDay(),
        'transaction_number' => 'TXN-002',
        'sale_id' => 2,
        'created_at' => now()->subDay(),
        'updated_at' => now()->subDay(),
    ]);

    // Act & Assert
    Livewire::actingAs($admin)
        ->test(TransactionSearcher::class)
        ->assertViewHas('transactions', function ($transactions) {
            return $transactions->count() === 2; // Should show both transactions initially
        })
        ->set('todays_transactions', true)
        ->assertViewHas('transactions', function ($transactions) use ($todayTransaction) {
            return $transactions->count() === 1 && // Should only show today's transaction
                   $transactions->first()->id === $todayTransaction->id;
        });

    $this->actingAs($admin)
        ->get(route('transaction'))
        ->assertSee('Mostrar solo las VENTAS de hoy');
});
