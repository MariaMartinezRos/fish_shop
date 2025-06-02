<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VacationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\VacationRequestActionRequest;

class VacationRequestActions extends Component
{
    public $vacationRequest;
    public $showModal = false;
    public $modalType = ''; // 'pending' or 'approved'
    public $requestId;
    public $type;

    protected $listeners = ['showVacationModal'];

    public function showVacationModal($requestId, $type)
    {
        $this->requestId = $requestId;
        $this->type = $type;
        
        $validated = $this->validate((new VacationRequestActionRequest())->rules(), (new VacationRequestActionRequest())->messages());
        
        Log::info('showVacationModal called', ['requestId' => $requestId, 'type' => $type]);
        
        $this->vacationRequest = VacationRequest::with('user')->find($requestId);
        $this->modalType = $type;
        $this->showModal = true;
    }

    public function approveRequest()
    {
        if (!$this->vacationRequest) return;

        // Check if the current user is an admin
        if (Auth::user()->role->name !== 'admin') {
            return;
        }

        $this->vacationRequest->update([
            'status' => 'approved'
        ]);

        $this->showModal = false;
        $this->dispatch('vacationRequestUpdated');
    }

    public function rejectRequest()
    {
        if (!$this->vacationRequest) return;

        // Check if the current user is an admin
        if (Auth::user()->role->name !== 'admin') {
            return;
        }

        $this->vacationRequest->update([
            'status' => 'rejected'
        ]);

        $this->showModal = false;
        $this->dispatch('vacationRequestUpdated');
    }

    public function render()
    {
        return view('livewire.vacation-request-actions');
    }
} 