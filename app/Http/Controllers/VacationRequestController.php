<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequestFormRequest;
use App\Jobs\VacationRequestEmailJob;
use App\Models\VacationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VacationRequestController extends Controller
{
//    public function __construct()
//    {
//        $this->authorizeResource(VacationRequest::class, 'vacationRequest');
//    }

    /**
     * Display a listing of vacation requests.
     */
//    public function index(): View
//    {
//        $vacationRequests = auth()->user()->role->name === 'admin'
//            ? VacationRequest::with('user')->latest()->get()
//            : auth()->user()->vacationRequests()->latest()->get();
//
//        return view('vacation-requests.index', compact('vacationRequests'));
//    }

    /**
     * Show the form for creating a new vacation request.
     */
//    public function create(): View
//    {
//        return view('vacation-requests.create');
//    }

    /**
     * Store a newly created vacation request.
     */
    public function store(VacationRequestFormRequest $request): RedirectResponse
    {
        $vacationRequest = auth()->user()->vacationRequests()->create($request->validated());

        VacationRequestEmailJob::dispatch($vacationRequest);

        return redirect()
            ->route('vacation-requests.index')
            ->with('success', 'Solicitud de vacaciones creada correctamente.');
    }

    /**
     * Display the specified vacation request.
     */
//    public function show(VacationRequest $vacationRequest): View
//    {
//        return view('vacation-requests.show', compact('vacationRequest'));
//    }

    /**
     * Show the form for editing the specified vacation request.
     */
//    public function edit(VacationRequest $vacationRequest): View
//    {
//        return view('vacation-requests.edit', compact('vacationRequest'));
//    }

    /**
     * Update the specified vacation request.
     */
    public function update(VacationRequestFormRequest $request, VacationRequest $vacationRequest): RedirectResponse
    {
        $vacationRequest->update($request->validated());

        return redirect()
            ->route('vacation-requests.index')
            ->with('success', 'Solicitud de vacaciones actualizada correctamente.');
    }

    /**
     * Remove the specified vacation request.
     */
    public function destroy(VacationRequest $vacationRequest): RedirectResponse
    {
        $vacationRequest->delete();

        return redirect()
            ->route('vacation-requests.index')
            ->with('success', 'Solicitud de vacaciones eliminada correctamente.');
    }
}
