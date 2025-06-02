<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\VacationRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Jobs\VacationRequestEmailJob;
use App\Mail\VacationRequestNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Http\Requests\VacationRequestFormRequest;

class VacationRequestForm extends Component
{
    public $start_date;
    public $end_date;
    public $comments;
    public $policy_acknowledged = false;

    public function submit()
    {
        $validated = $this->validate((new VacationRequestFormRequest())->rules(), (new VacationRequestFormRequest())->messages());

        // Verificar si ya tiene una solicitud aprobada
        $hasApprovedVacation = VacationRequest::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->exists();

        if ($hasApprovedVacation) {
            session()->flash('error', 'No puedes solicitar vacaciones porque ya tienes una solicitud aprobada.');
            return;
        }

        $vacationRequest = VacationRequest::create([
            'user_id' => Auth::id(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'comments' => $this->comments,
            'status' => 'pending'
        ]);

        // Dispatch email job
        VacationRequestEmailJob::dispatch($vacationRequest);

        $this->reset();
        $this->dispatch('vacation-request-submitted');
        session()->flash('message', 'Vacation request submitted successfully!');
    }

    public function downloadPdf()
    {
        $validated = $this->validate((new VacationRequestFormRequest())->rules(), (new VacationRequestFormRequest())->messages());

        $data = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'comments' => $this->comments,
            'employee' => Auth::user(),
            'requested_at' => now()->format('Y-m-d H:i:s')
        ];

        $pdf = PDF::loadView('pdf.vacation-request', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'vacation-request.pdf');
    }

    public function render()
    {
        $hasApprovedVacation = VacationRequest::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->exists();

        return view('livewire.employee.vacation-request', [
            'hasApprovedVacation' => $hasApprovedVacation
        ]);
    }
}
