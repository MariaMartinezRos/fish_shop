<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    // Listar usuarios
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Crear usuario
    public function create()
    {
        return view('users.create');
    }

    // Guardar usuario
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required|in:1,3,4'
        ]);


            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            // Asignación de rol
            $user->roles()->attach($validated['role_id']);

            return redirect()
                ->route('users.index')
                ->with('success', 'User created successfully');

    }


    // Editar usuario
    public function edit(User $user)
    {
        if ($user->role_id != 1) {
            return redirect()->route('users.index')->with('error', 'You cannot edit this user');
        }
        return view('users.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|in:admin,costumer,employee'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Eliminar UN usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    // Eliminar TODOS los usuarios

//    public function deleteAll()
//    {
//        User::truncate();
//        return redirect()->route('users.index')->with('success', 'All users deleted successfully');
//    }

}
