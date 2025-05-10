<?php

use App\Livewire\EmployeeLayoutComponent;
use App\Models\Role;
use App\Models\User;
use Livewire\Livewire;

it('renders the employee layout correctly', function () {
// Arrange
    $role = Role::factory()->create(['id' => 2]);
    $employee = User::factory()->create(['role_id' => $role->id]);

// Act
    $this->actingAs($employee)
        ->get('employee/home')
        ->assertSee('Vista del Empleado');
//        ->assertSee('Employee Layout')
//        ->assertSee('Schedule')
//        ->assertSee('Schedule')
//        ->assertSee('Download Paycheck')
//        ->assertSee('Assignements')
//        ->assertSee('Reports')
//        ->assertSee('Study');
});

it('does not render custom content when content is empty', function () {
// Arrange
    $role = Role::factory()->create(['id' => 2]);
    $employee = User::factory()->create(['role_id' => $role->id]);

// Act
    $this->actingAs($employee)
        ->get('employee/home')
        ->assertDontSee('custom-content');
})->todo();

it('renders custom content if provided', function () {
// Arrange
    $role = Role::factory()->create(['id' => 2]);
    $employee = User::factory()->create(['role_id' => $role->id]);

// Act
    $this->actingAs($employee)
        ->get('employee/home')
        ->set('content', '<p>Custom Employee Info</p>')
        ->assertSeeHtml('<p>Custom Employee Info</p>');
})->todo();
