<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class ScheduleDownload extends Component
{
    public function download()
    {
        $pdf = Pdf::loadView('pdf.schedule');

        $filename = __('weekly-schedule') . '.pdf';

        return Response::streamDownload(
            fn () => print($pdf->output()),
            $filename
        );
    }

    public function render()
    {
        return view('livewire.employee.schedule-download');
    }
}
