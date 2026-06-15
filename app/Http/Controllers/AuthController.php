<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user'     => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->user, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $loginData = [
            $fieldType => $request->user,
            'password' => $request->password
        ];

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'user' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('user');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}