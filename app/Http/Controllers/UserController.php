<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use AuthorizesRequests;

    // Listar usuarios
    public function index()
    {

        $this->authorize('view', User::class);

        $users = User::all();

        return view('users.index', compact('users'));
    }

    // Crear usuario
    public function create()
    {
        $this->authorize('create', User::class);

        return view('users.create');
    }

    // Guardar usuario
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required|in:1,3,4',
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
        $this->authorize('update', User::class);

        return view('users.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $this->authorize('update', User::class);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role_id' => 'required|in:1,3,4',
        ]);

        if ($validated['role_id'] == 1) {
            $role = 'admin';
        } elseif ($validated['role_id'] == 3) {
            $role = 'employee';
        } else {
            $role = 'customer';
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $role,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    // Eliminar UN usuario
    public function destroy(User $user)
    {
        $this->authorize('delete', User::class);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
