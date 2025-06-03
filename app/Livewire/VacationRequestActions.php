<?php

namespace App\Livewire;

use App\Models\VacationRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VacationRequestActions extends Component
{
    public $showModal = false;
    public $requestId = null;
    public $action = '';
    public $comments = '';
    public $status = '';

    protected $rules = [
        'comments' => 'required|min:10|max:500'
    ];

    protected $messages = [
        'comments.required' => 'Los comentarios son obligatorios.',
        'comments.min' => 'Los comentarios deben tener al menos 10 caracteres.',
        'comments.max' => 'Los comentarios no pueden tener más de 500 caracteres.'
    ];

    public function showVacationModal($requestId, $action)
    {
        $this->requestId = $requestId;
        $this->action = $action;
        $request = VacationRequest::findOrFail($requestId);
        $this->status = $request->status;
        $this->showModal = true;
    }

    public function approveRequest()
    {
        $this->validate();
        $request = VacationRequest::findOrFail($this->requestId);
        $request->update([
            'status' => 'approved',
            'comments' => $this->comments
        ]);
        $this->showModal = false;
        $this->reset(['comments', 'action', 'requestId']);
        $this->dispatch('vacationRequestUpdated');
    }

    public function rejectRequest()
    {
        $this->validate();
        $request = VacationRequest::findOrFail($this->requestId);
        $request->update([
            'status' => 'rejected',
            'comments' => $this->comments
        ]);
        $this->showModal = false;
        $this->reset(['comments', 'action', 'requestId']);
        $this->dispatch('vacationRequestUpdated');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['comments', 'action', 'requestId']);
    }

    public function render()
    {
        return view('livewire.vacation-request-actions');
    }
} 