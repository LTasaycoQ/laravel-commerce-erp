<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Importa tus otros modelos si existen
// use App\Models\Proveedor;
// use App\Models\Destino;
// use App\Models\Contacto;

class DashboardController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $isAdmin = $user->hasRole('admin');

        if ($isAdmin) {
            $totalUsers     = User::count();
            $activeUsers    = User::count(); // ajusta si tienes campo "activo"
            $adminCount     = User::role('admin')->count();
            $newThisMonth   = User::whereMonth('created_at', now()->month)
                                  ->whereYear('created_at', now()->year)
                                  ->count();
            $newToday       = User::whereDate('created_at', today())->count();
            $recentUsers    = User::latest()->take(5)->get();

            return view('products.dashboard', compact(
                'totalUsers', 'activeUsers', 'adminCount',
                'newThisMonth', 'newToday', 'recentUsers'
            ));
        }

        // Vista de usuario normal
        $totalClientes    = Cliente::count();
        $totalContactos   = 0; // reemplaza con tu modelo: Contacto::count()
        $totalProveedores = 0; // reemplaza con tu modelo: Proveedor::count()
        $totalDestinos    = 0; // reemplaza con tu modelo: Destino::count()
        $recentClientes   = Cliente::with('contactos')->latest()->take(5)->get();
        $recentProveedores = collect(); // reemplaza con Proveedor::latest()->take(5)->get()

        return view('products.dashboard', compact(
            'totalClientes', 'totalContactos', 'totalProveedores',
            'totalDestinos', 'recentClientes', 'recentProveedores'
        ));
    }
}
