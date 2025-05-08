<?php

use App\Events\UserCreated;
use App\Jobs\GenerateWeeklyTransactionsReportJob;
use App\Jobs\SendContactConfirmationEmail;
use App\Listeners\SendWelcomeEmail;
use App\Mail\ContactConfirmation;
use App\Mail\WeeklyTransactionsReportEmail;
use App\Mail\WelcomeMail;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

it('includes login details for the welcome mail', function () {
    // Arrange
    $user = User::factory()->create();

    // Act
    $mail = new WelcomeMail($user);

    // Assert
    $mail->AssertSeeInText("Gracias por crear una cuenta, {$user->name}!!");
    $mail->AssertSeeInText('Login');
    $mail->AssertSeeInHtml(route('login'));

});

it('sends a welcome email when a user is created', function () {
    // Arrange
    Mail::fake();
    $user = User::factory()->create();
    $event = new UserCreated($user);

    // Act
    $listener = new SendWelcomeEmail;
    $listener->handle($event);

    // Assert
    Mail::assertSent(WelcomeMail::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
});

it('sends the confirmation email for the contact page', function () {
    // Arrange
    Mail::fake();
    $user = User::factory()->create();

    // Act
    SendContactConfirmationEmail::dispatch($user);

    // Assert
    Mail::assertQueued(ContactConfirmation::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
});

it('includes valid data for the contact mail', function () {
    // Arrange
    $response = $this->post(route('contact.submit'), [
        'name' => '',
        'email' => 'invalid-email',
        'message' => '',
    ]);

    // Act && Assert
    $response->assertSessionHasErrors(['name', 'email', 'message']);
});

it('sends a weekly report email with the correct summary', function () {
    // Arrange
    Mail::fake();

    $startOfWeek = Carbon::now()->startOfWeek();
    $withinWeek = $startOfWeek->copy()->addDays(5);

    // Act
    Transaction::factory()->create([
        'amount' => 50,
        'date_time' => $withinWeek,
        'tpv' => 'TPV-001',
        'terminal_number' => 'TERM-01',
        'operation' => 'sale',
        'card_number' => '1234567812345678',
        'transaction_number' => 'TXN-001',
    ]);

    (new GenerateWeeklyTransactionsReportJob())->handle();

    // Assert
    Mail::assertSent(WeeklyTransactionsReportEmail::class, function ($mail) use ($startOfWeek) {
        expect($mail->summary)->toBeArray();
        expect($mail->summary['transaction_count'])->toBe(1);
        expect($mail->summary['total_sales'])->toBe(50);
        expect($mail->summary['start'])->toBe($startOfWeek->toDateString());

        return true;
    });
});
