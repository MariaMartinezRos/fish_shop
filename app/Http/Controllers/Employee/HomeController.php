<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeController extends Controller
{
    use AuthorizesRequests;

    /**
     * Shows the categories page.
     */
    public function index()
    {
        return view('employee.home');
    }
}
