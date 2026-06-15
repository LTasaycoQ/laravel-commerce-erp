<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
  
public function index(Request $request)
{
    $query = $request->input('search');

    $clientes = Cliente::when($query, function ($q) use ($query) {
        return $q->where('name_client', 'LIKE', "%{$query}%")
                 ->orWhere('id_client', 'LIKE', "%{$query}%");
    })->paginate(10); 

    return view('products.clientes', compact('clientes'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name_client'          => 'required|string|max:150',
            
            'contactos'            => 'required|array|min:1', 
            'contactos.*.name'     => 'required|string|max:100',
            'contactos.*.last_names'=> 'nullable|string|max:100',
            'contactos.*.email'    => 'nullable|email|max:100',
            'contactos.*.first_phone'=> 'nullable|string|max:20',
            'contactos.*.second_phone'=> 'nullable|string|max:20',
        ]);

        DB::beginTransaction();

        try {
            $cliente = Cliente::create([
                'name_client' => $request->name_client,
            ]);

            foreach ($request->contactos as $index => $datosContacto) {
                
                $esPrincipal = ($index === 0) ? true : false;

                $cliente->contactos()->create([
                    'name'         => $datosContacto['name'],
                    'last_names'   => $datosContacto['last_names'],
                    'email'        => $datosContacto['email'],
                    'first_phone'  => $datosContacto['first_phone'],
                    'second_phone' => $datosContacto['second_phone'],
                    'es_principal' => $esPrincipal,
                ]);
            }

            DB::commit();

            return redirect()->route('clientes.index')
                             ->with('success', '¡Cliente y todos sus contactos registrados con éxito, mano!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error_db' => 'Error al registrar el grupo: ' . $e->getMessage()
            ])->withInput();
        }
    }
}