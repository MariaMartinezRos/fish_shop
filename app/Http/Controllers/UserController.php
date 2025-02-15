<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|in:admin,costumer,employee'

//            'role_id' => 'required|exists:roles,id'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // Editar usuario
    public function edit(User $user)
    {
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
