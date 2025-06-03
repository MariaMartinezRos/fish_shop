<?php

namespace App\Livewire;

use App\Models\VacationRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class VacationRequestForm extends Component
{
    public $start_date = '';
    public $end_date = '';
    public $comments = '';
    public $policy_acknowledged = false;

    protected $rules = [
        'start_date' => 'required|date|after:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'comments' => 'nullable|string|max:500',
        'policy_acknowledged' => 'required|accepted'
    ];

    protected $messages = [
        'start_date.required' => 'La fecha de inicio es obligatoria.',
        'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
        'start_date.after' => 'La fecha de inicio debe ser posterior a hoy.',
        'end_date.required' => 'La fecha de fin es obligatoria.',
        'end_date.date' => 'La fecha de fin debe ser una fecha válida.',
        'end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
        'comments.max' => 'Los comentarios no pueden tener más de 500 caracteres.',
        'policy_acknowledged.required' => 'Debes aceptar la política de vacaciones.',
        'policy_acknowledged.accepted' => 'Debes aceptar la política de vacaciones.'
    ];

    public function mount()
    {
        if (auth()->user()->isAdmin()) {
            abort(403);
        }
    }

    public function submit()
    {
        $this->validate();

        VacationRequest::create([
            'user_id' => auth()->id(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'comments' => $this->comments,
            'status' => 'pending'
        ]);

        $this->reset(['start_date', 'end_date', 'comments', 'policy_acknowledged']);
        $this->dispatch('vacationRequestCreated');
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Solicitud de vacaciones enviada correctamente.'
        ]);
    }

    public function getTotalDaysProperty()
    {
        if (!$this->start_date || !$this->end_date) {
            return 0;
        }

        return Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date)) + 1;
    }

    public function render()
    {
        return view('livewire.vacation-request-form');
    }
} 