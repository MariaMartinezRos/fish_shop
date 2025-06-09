<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactConfirmationEmail;
use App\Models\User;
use App\Policies\ContactPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use AuthorizesRequests;

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Despachar el Job para enviar el correo de confirmación
        SendContactConfirmationEmail::dispatch(User::where('email', $validated['email'])->first());

        return back()->with('success', __('Your message has been sent successfully!'));
    }
}
