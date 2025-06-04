<?php

use App\Livewire\Employee\ScheduleDownload;
use Livewire\Livewire;

it('can render the component', function () {
    Livewire::test(ScheduleDownload::class)
        ->assertStatus(200);
});
