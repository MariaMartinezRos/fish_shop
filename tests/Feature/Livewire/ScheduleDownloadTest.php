<?php

use Livewire\Livewire;
use App\Livewire\Employee\ScheduleDownload;

    it('can render the component', function () {
        Livewire::test(ScheduleDownload::class)
            ->assertStatus(200);
    });
