<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Policies\EmployeeHomePolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeController extends Controller
{
    use AuthorizesRequests;

    /**
     * Shows the employee home page.
     */
    public function index()
    {
        return view('employee.home');
    }
}
