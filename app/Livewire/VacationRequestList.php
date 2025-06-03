<?php

namespace App\Livewire;

use App\Models\VacationRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class VacationRequestList extends Component
{
    use WithPagination;

    public $status = '';
    public $sortField = 'start_date';
    public $sortDirection = 'asc';

    protected $queryString = [
        'status' => ['except' => ''],
        'sortField' => ['except' => 'start_date'],
        'sortDirection' => ['except' => 'desc'],
    ];

    protected $listeners = ['vacationRequestUpdated' => '$refresh'];

    public function mount()
    {
        $this->sortField = 'start_date';
        $this->sortDirection = 'asc';
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function getVacationRequestsProperty()
    {
        $query = VacationRequest::query()
            ->with('user')
            ->when(!auth()->user()->isAdmin(), function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->orderBy($this->sortField, $this->sortDirection);

        return $query->paginate(10);
    }

    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.vacation-request-list', [
            'vacationRequests' => $this->vacationRequests
        ]);
    }
} 