<?php

use App\Livewire\Employee\ScheduleDownload;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Livewire;

it('generates and downloads schedule pdf', function () {
    // Mock PDF facade
    Pdf::shouldReceive('loadView')
        ->once()
        ->with('pdf.schedule')
        ->andReturnSelf();

    Pdf::shouldReceive('output')
        ->once()
        ->andReturn('PDF content');

    // Create and test the component
    Livewire::test(ScheduleDownload::class)
        ->call('download')
        ->assertHeader('Content-Type', 'application/json');
});

it('renders the component view', function () {
    Livewire::test(ScheduleDownload::class)
        ->assertViewIs('livewire.employee.schedule-download');
});
