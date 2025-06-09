<?php

use App\Livewire\Employee\Calendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

it('shows current month by default', function () {
    Livewire::test(Calendar::class)
        ->assertSee(ucfirst(strtolower(Carbon::now()->locale('es')->monthName)))
        ->assertSee(Carbon::now()->year);
});

it('navigates to next month', function () {
    $nextMonth = Carbon::now()->addMonth();

    Livewire::test(Calendar::class)
        ->call('nextMonth')
        ->assertSee(ucfirst(strtolower($nextMonth->locale('es')->monthName)))
        ->assertSee($nextMonth->year);
});

it('navigates to previous month', function () {
    $prevMonth = Carbon::now()->subMonth();

    Livewire::test(Calendar::class)
        ->call('previousMonth')
        ->assertSee(ucfirst(strtolower($prevMonth->locale('es')->monthName)))
        ->assertSee($prevMonth->year);
});

it('shows holidays from API', function () {
    $holiday = [
        'date' => Carbon::now()->format('Y-m-d 00:00:00'),
        'name' => 'Test Holiday',
        'type' => 'public',
        'rule' => '01-01',
    ];

    Http::fake([
        'api.generadordni.es/v2/holidays/holidays*' => Http::response([$holiday]),
    ]);

    Livewire::test(Calendar::class)
        ->assertSee(Carbon::now()->day)
        ->assertDontSee('¡Las vacaciones estarán disponibles pronto!');
});

it('handles API errors gracefully', function () {
    Http::fake([
        'api.generadordni.es/v2/holidays/holidays*' => Http::response([], 500),
    ]);

    Livewire::test(Calendar::class)
        ->assertSee('¡Las vacaciones estarán disponibles pronto!')
        ->assertSee(Carbon::now()->day);
});

it('shows weekend days with blue background', function () {
    $sunday = Carbon::now()->startOfWeek();

    Livewire::test(Calendar::class)
        ->assertSeeHtml('bg-blue-500')
        ->assertSee($sunday->day);
});

it('shows holiday days with red background', function () {
    $holiday = [
        'date' => Carbon::now()->format('Y-m-d 00:00:00'),
        'name' => 'Test Holiday',
        'type' => 'public',
        'rule' => '01-01',
    ];

    Http::fake([
        'api.generadordni.es/v2/holidays/holidays*' => Http::response([$holiday]),
    ]);

    Livewire::test(Calendar::class)
        ->assertSeeHtml('bg-red-500')
        ->assertSee(Carbon::now()->day);
});

it('shows regular days with gray background', function () {
    $regularDay = Carbon::now()->next('Wednesday');

    Livewire::test(Calendar::class)
        ->assertSeeHtml('bg-gray-200')
        ->assertSee($regularDay->day);
});

it('shows holiday information when clicking on a holiday', function () {
    $holiday = [
        'date' => Carbon::now()->format('Y-m-d 00:00:00'),
        'name' => 'Test Holiday',
        'type' => 'public',
        'rule' => '01-01',
    ];

    Http::fake([
        'api.generadordni.es/v2/holidays/holidays*' => Http::response([$holiday]),
    ]);

    Livewire::test(Calendar::class)
        ->call('selectDay', Carbon::now()->day)
        ->assertSee('Test Holiday')
        ->assertSee('Fiesta Nacional');
});

it('does not show holiday information when clicking on a non-holiday', function () {
    $regularDay = Carbon::now()->next('Wednesday');

    Livewire::test(Calendar::class)
        ->call('selectDay', $regularDay->day)
        ->assertDontSee('Festivo Público')
        ->assertDontSee('Fiesta Regional');
});
