<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;

use Illuminate\Http\Request;

class ProveedorController extends Controller
{
 public function index(Request $request)
{
    $query = $request->input('search');

    $proveedores = Proveedor::with(['categoria', 'destino'])
        ->when($query, function ($q) use ($query) {
            return $q->where('supplier_name', 'LIKE', "%{$query}%")
                     ->orWhereHas('categoria', fn($q) => $q->where('category_name', 'LIKE', "%{$query}%"))
                     ->orWhereHas('destino', fn($q) => $q->where('destination_name', 'LIKE', "%{$query}%"))
                     ->orWhere('created_at', 'LIKE', "%{$query}%");
        })->paginate(10);

    return view('products.suppliers', compact('proveedores'));
}

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name_client'          => 'required|string|max:150',
            
    //         'contactos'            => 'required|array|min:1', 
    //         'contactos.*.name'     => 'required|string|max:100',
    //         'contactos.*.last_names'=> 'nullable|string|max:100',
    //         'contactos.*.email'    => 'nullable|email|max:100',
    //         'contactos.*.first_phone'=> 'nullable|string|max:20',
    //         'contactos.*.second_phone'=> 'nullable|string|max:20',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $cliente = Cliente::create([
    //             'name_client' => $request->name_client,
    //         ]);

    //         foreach ($request->contactos as $index => $datosContacto) {
                
    //             $esPrincipal = ($index === 0) ? true : false;

    //             $cliente->contactos()->create([
    //                 'name'         => $datosContacto['name'],
    //                 'last_names'   => $datosContacto['last_names'],
    //                 'email'        => $datosContacto['email'],
    //                 'first_phone'  => $datosContacto['first_phone'],
    //                 'second_phone' => $datosContacto['second_phone'],
    //                 'es_principal' => $esPrincipal,
    //             ]);
    //         }

    //         DB::commit();

    //         return redirect()->route('clientes.index')
    //                          ->with('success', '¡Cliente y todos sus contactos registrados con éxito, mano!');

    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return back()->withErrors([
    //             'error_db' => 'Error al registrar el grupo: ' . $e->getMessage()
    //         ])->withInput();
    //     }
    // }
}