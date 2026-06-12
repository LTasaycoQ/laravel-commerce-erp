<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('products.index');
});

Route::post('/login', function (Request $request) {
    if ($request->input('user') === 'dw@fiestatoursperu.com' && $request->input('password') === 'luis123') {
        session(['autenticado' => true]);
        return redirect('/dashboard');
    }
    
    return back()->with('error', 'Credenciales incorrectas');
});

Route::get('/dashboard', function () {
    if (!session('autenticado')) {
        return redirect('/');
    }
    return view('products.dashboard');
});