<?php

use App\Jobs\VacationRequestEmailJob;
use App\Models\Role;
use App\Models\User;
use App\Models\VacationRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;

use function Pest\Laravel\get;

beforeEach(function () {


    $this->employee = User::factory()->create([
        'role_id' =>2,
    ]);

    $this->admin = User::factory()->create([
        'role_id' => 1,
    ]);
});

test('employee can access vacation request page', function () {
    $this->actingAs($this->employee)
        ->get(route('employee.vacation-request'))
        ->assertOk()
        ->assertSeeLivewire('employee.vacation-request-form');
})->todo();

test('admin can access vacation request page', function () {
    $this->actingAs($this->admin)
        ->get(route('employee.vacation-request'))
        ->assertOk()
        ->assertSeeLivewire('employee.vacation-request-form');
})->todo('decidir si quitar el employee middleware o no');

test('non employee cannot access vacation request page', function () {
    get(route('employee.vacation-request'))
        ->assertRedirect('login');
});

test('vacation request form validation works', function () {
    Livewire::actingAs($this->employee)
        ->test('employee.vacation-request-form')
        ->set('start_date', '')
        ->set('end_date', '')
        ->set('comments', '')
        ->set('policy_acknowledged', false)
        ->call('submit')
        ->assertHasErrors(['start_date', 'end_date', 'comments', 'policy_acknowledged']);
});

test('employee can submit vacation request', function () {
    Queue::fake();
    Mail::fake();

    $component = Livewire::actingAs($this->employee)
        ->test('employee.vacation-request-form')
        ->set('start_date', now()->addDays(5)->format('Y-m-d'))
        ->set('end_date', now()->addDays(10)->format('Y-m-d'))
        ->set('comments', 'I need a vacation for personal reasons')
        ->set('policy_acknowledged', true)
        ->call('submit');

    $component->assertSee('¡Solicitud de vacaciones enviada con éxito!');

    $this->assertDatabaseHas('vacation_requests', [
        'user_id' => $this->employee->id,
        'status' => 'pending',
    ]);

    Queue::assertPushed(VacationRequestEmailJob::class);
});

test('employee can download vacation request pdf', function () {
    $response = $this->actingAs($this->employee)
        ->post(route('employee.vacation-request.pdf'), [
            'start_date' => now()->addDays(5)->format('Y-m-d'),
            'end_date' => now()->addDays(10)->format('Y-m-d'),
            'comments' => 'I need a vacation for personal reasons',
            'policy_acknowledged' => true,
        ]);

    $response->assertHeader('Content-Type', 'text/html; charset=utf-8');
    //    $response->assertHeader('Content-Disposition', 'attachment; filename="vacation-request.pdf"');
});

test('vacation request email is sent to admin', function () {
    Mail::fake();

    $vacationRequest = VacationRequest::create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(5),
        'end_date' => now()->addDays(10),
        'comments' => 'Test vacation request',
        'status' => 'pending',
    ]);

    $job = new VacationRequestEmailJob($vacationRequest);
    $job->handle();

    Mail::assertSent(function ($mail) {
        return $mail->hasTo($this->admin->email) &&
               $mail->subject === 'Nueva Solicitud de Vacaciones - PESCADERIAS BENITO';
    });
})->todo();

test('vacation request status is displayed correctly in users list', function () {
    // Create vacation requests with different statuses
    $pendingRequest = VacationRequest::create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(5),
        'end_date' => now()->addDays(10),
        'comments' => 'Pending request',
        'status' => 'pending',
    ]);

    $approvedRequest = VacationRequest::create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(15),
        'end_date' => now()->addDays(20),
        'comments' => 'Approved request',
        'status' => 'approved',
    ]);

    $rejectedRequest = VacationRequest::create([
        'user_id' => $this->employee->id,
        'start_date' => now()->addDays(25),
        'end_date' => now()->addDays(30),
        'comments' => 'Rejected request',
        'status' => 'rejected',
    ]);

    // Test each status is displayed correctly
    $response = $this->actingAs($this->admin)
        ->get(route('users.index'));

    // Should show the latest request status (rejected)
    $response->assertStatus(200)
        ->assertSee('images/available-dot.png')
        ->assertSee('Rejected');

    // Delete the rejected request to test approved status
    $rejectedRequest->delete();
    $response = $this->actingAs($this->admin)
        ->get(route('users.index'));
    $response->assertStatus(200)
        ->assertSee('images/unavailable-dot.png')
        ->assertSee('Approved');

    // Delete the approved request to test pending status
    $approvedRequest->delete();
    $response = $this->actingAs($this->admin)
        ->get(route('users.index'));
    $response->assertStatus(200)
        ->assertSee('images/available-dot.png')
        ->assertSee('Pending');
})->todo();

test('non employee users show dash in status column', function () {
    $response = $this->actingAs($this->admin)
        ->get(route('users.index'));

    $response->assertSee('-');
    $response->assertDontSee('images/available-dot.png');
    $response->assertDontSee('images/unavailable-dot.png');
})->todo();
