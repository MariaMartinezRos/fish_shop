<?php

it('returns a succesfull response for employee controller', function () {
    $employee = \App\Models\User::factory()->create([ 'role_id' => 2 ]);
    $this->actingAs($employee)
        ->get(route('employee.calendar'))
        ->assertStatus(200)
        ->assertViewIs('employee.calendar');
});
