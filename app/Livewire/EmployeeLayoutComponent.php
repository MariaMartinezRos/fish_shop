<?php

namespace App\Livewire;

use Livewire\Component;

class EmployeeLayoutComponent extends Component
{
    public $title = "Employee Layout";

    public function render()
    {
        return view('livewire.employee-layout-component');
    }
}
