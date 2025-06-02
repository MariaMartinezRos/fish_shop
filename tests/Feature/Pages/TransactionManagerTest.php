<?php

use App\Livewire\TransactionManager;
use App\Models\Transaction;
use App\Models\Role;
use App\Models\User;

use function Pest\Laravel\get;
//
//it('returns a successful response for transaction page', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    // Act
//    $this->actingAs($employee)
//        ->get('employee/transactions')
//        ->assertOk()
//        ->assertStatus(200);
//});
//
//it('cannot be accessed by guest', function () {
//    // Act & Assert
//    get('employee/transactions')
//        ->assertRedirect(route('login'));
//});
//
//it('cannot be accessed by customer', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 4]);
//    $customer = User::factory()->create(['role_id' => 4]);
//
//    // Act
//    $this->actingAs($customer)
//        ->get('employee/transactions')
//        ->assertRedirect(route('login'));
//});
//
//it('can be accessed by employee', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    // Act
//    $this->actingAs($employee)
//        ->get('employee/transactions')
//        ->assertOk();
//});
//
//it('can be accessed by admin', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 1]);
//    $admin = User::factory()->create(['role_id' => 1]);
//
//    // Act
//    $this->actingAs($admin)
//        ->get('employee/transactions')
//        ->assertOk();
//});
//
//it('renders the transaction manager component', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->assertViewIs('livewire.transaction-manager');
//});
//
//it('displays a list of transactions', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    $transactions = Transaction::factory()->count(3)->create();
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->assertSee($transactions[0]->tpv)
//        ->assertSee($transactions[1]->tpv)
//        ->assertSee($transactions[2]->tpv);
//});
//
//it('shows a message when no transactions are available', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->assertSee('No transactions found.');
//});
//
//it('can create a new transaction as employee', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->set('tpv', 'PESCADERIA BENITO ALHAMA')
//        ->set('serial_number', 'SN123456')
//        ->set('terminal_number', 'TERM-001')
//        ->set('operation', 'sale')
//        ->set('amount', 99.99)
//        ->set('card_number', '1234567890123456')
//        ->set('date_time', now()->format('Y-m-d\TH:i'))
//        ->set('transaction_number', 'TXN-001')
//        ->set('sale_id', 1)
//        ->call('store')
//        ->assertSee('Transaction created successfully.');
//
//    $this->assertDatabaseHas('transactions', [
//        'tpv' => 'PESCADERIA BENITO ALHAMA',
//        'serial_number' => 'SN123456',
//        'terminal_number' => 'TERM-001',
//        'operation' => 'sale',
//        'amount' => 99.99,
//        'card_number' => '1234567890123456',
//        'transaction_number' => 'TXN-001',
//        'sale_id' => 1,
//    ]);
//});
//
//it('cannot edit a transaction as employee', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    $transaction = Transaction::factory()->create();
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->call('edit', $transaction)
//        ->assertForbidden();
//});
//
//it('cannot delete a transaction as employee', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    $transaction = Transaction::factory()->create();
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->call('delete', $transaction->id)
//        ->assertForbidden();
//});
//
//it('validates required fields when creating a transaction', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->set('tpv', '')
//        ->set('serial_number', '')
//        ->set('terminal_number', '')
//        ->set('operation', '')
//        ->set('amount', '')
//        ->set('card_number', '')
//        ->set('date_time', '')
//        ->set('transaction_number', '')
//        ->set('sale_id', '')
//        ->call('store')
//        ->assertHasErrors(['tpv', 'serial_number', 'terminal_number', 'operation', 'amount', 'card_number', 'date_time', 'transaction_number', 'sale_id']);
//});
//
//it('validates amount is numeric and not negative', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->set('amount', -100)
//        ->call('store')
//        ->assertHasErrors(['amount']);
//});
//
//it('validates card number is exactly 16 digits', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->set('card_number', '123456')
//        ->call('store')
//        ->assertHasErrors(['card_number']);
//});
//
//it('can search transactions', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    Transaction::factory()->create(['tpv' => 'PESCADERIA BENITO ALHAMA']);
//    Transaction::factory()->create(['tpv' => 'PESCADERIA BENITO LIBRILLA']);
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->set('search', 'ALHAMA')
//        ->assertSee('PESCADERIA BENITO ALHAMA')
//        ->assertDontSee('PESCADERIA BENITO LIBRILLA');
//});
//
//it('paginates transactions', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    Transaction::factory()->count(15)->create();
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->assertSee('Previous')
//        ->assertSee('Next');
//});
//
//it('shows create form when clicking add transaction button', function () {
//    // Arrange
//    $role = Role::factory()->create(['id' => 3]);
//    $employee = User::factory()->create(['role_id' => 3]);
//
//    // Act & Assert
//    Livewire::actingAs($employee)
//        ->test(TransactionManager::class)
//        ->call('create')
//        ->assertSet('creating', true)
//        ->assertSet('editing', false);
//});
