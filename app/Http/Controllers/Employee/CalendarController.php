<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function index()
    {
        return view('employee.calendar');
    }
}
