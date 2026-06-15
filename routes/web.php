<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UserController; 

// 1. Cargar vista de login
Route::get('/', function () {
    return view('products.login');
})->name('login');

Route::get('/login', function () {
    return redirect('/');
});

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

// =======================================================================
// RUTAS PROTEGIDAS PARA USUARIOS LOGUEADOS (AUTH)
// =======================================================================
Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Panel Principal
    Route::get('/dashboard', function () {
        return view('products.dashboard');
    });

    Route::get('/proveedores', function () {
        return view('products.suppliers');
    });

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');


    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');

  
    // =======================================================================
    // 🔒 RUTAS EXCLUSIVAS PARA ADMINISTRADORES (role:admin)
    // =======================================================================
    Route::middleware('role:admin')->group(function () {
        
       Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/admin/users', [UserController::class, 'store']);
    });

});