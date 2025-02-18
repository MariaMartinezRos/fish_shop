<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactConfirmationEmail;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);


        // Despachar el Job para enviar el correo de confirmación
        SendContactConfirmationEmail::dispatch(User::where('email', $request->email)->first());

        return back()->with('success', 'Your message has been sent successfully!');
    }
}

