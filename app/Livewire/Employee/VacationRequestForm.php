<?php

namespace App\Livewire\Employee;

use App\Http\Requests\VacationRequestFormRequest;
use App\Jobs\VacationRequestEmailJob;
use App\Models\User;
use App\Models\VacationRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VacationRequestForm extends Component
{
    public $start_date;

    public $end_date;

    public $comments;

    public $policy_acknowledged = false;

    public function submit(): void
    {
        $validated = $this->validate((new VacationRequestFormRequest)->rules(), (new VacationRequestFormRequest)->messages());

        $hasApprovedVacation = User::hasApprovedVacation()->exists();

        if ($hasApprovedVacation) {
            session()->flash('error', __('You cannot request vacation because you already have an approved request.'));

            return;
        }

        $vacationRequest = VacationRequest::create([
            'user_id' => Auth::id(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'comments' => $this->comments,
            'status' => 'pending',
        ]);

        // Calculate days requested
        
        //$vacationRequest->days_requested = $daysRequested;
        //$vacationRequest->save();

        // Dispatch email job
        VacationRequestEmailJob::dispatch($vacationRequest);

        $this->reset();
        $this->dispatch('vacation-request-submitted');
        session()->flash('message', __('Vacation request submitted successfully!'));
    }

    public function downloadPdf(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $validated = $this->validate((new VacationRequestFormRequest)->rules(), (new VacationRequestFormRequest)->messages());

        $data = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'days_requested' => \Carbon\Carbon::parse($this->start_date)->diffInDays(\Carbon\Carbon::parse($this->end_date)) + 1,
            'comments' => $this->comments,
            'employee' => Auth::user(),
            'requested_at' => now()->format('Y-m-d H:i:s'),
        ];

        $pdf = PDF::loadView('pdf.vacation-request', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'vacation-request.pdf');
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $hasApprovedVacation = VacationRequest::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->exists();

        return view('livewire.employee.vacation-request', [
            'hasApprovedVacation' => $hasApprovedVacation,
        ]);
    }
}
