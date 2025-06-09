<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    $this->admin = User::factory()->create(['role_id' => 1]);
});

it('can generate weekly report when admin is authenticated', function () {
    Artisan::shouldReceive('call')
        ->once()
        ->with('app:run-weekly-report')
        ->andReturn(0);

    $response = $this->actingAs($this->admin)
        ->post(route('weekly.report'));

    $response->assertRedirect();
    $response->assertSessionHas('status', 'success');
});

it('cannot access weekly report route when not authenticated', function () {
    $response = $this->post(route('weekly.report'));

    $response->assertRedirect(route('login'));
});

it('cannot access weekly report route when not admin', function () {
    $user = User::factory()->create(['role_id' => 4]);

    $response = $this->actingAs($user)
        ->post(route('weekly.report'));

    $response->assertStatus(302);
});
