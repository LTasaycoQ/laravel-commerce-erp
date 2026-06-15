<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = trim($request->input('search'));

    $users = User::when($query, function ($q) use ($query) {
            return $q->where('id', 'LIKE', "%{$query}%")
                    ->orWhere('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->orWhere('created_at', 'LIKE', "%{$query}%");
        })
        ->paginate(10);

    return view('admin.users', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|string|email|max:150|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string|in:admin,user',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $roleSelected = Role::firstOrCreate(['name' => $request->input('role')]);
        $user->assignRole($roleSelected);

        return redirect('/users')->with(
            'success', 
            '¡Usuario registrado con éxito con el rol de ' . strtoupper($request->input('role')) . '!'
        );
    }
}