<x-layout>
    <x-slot name="title">Proveedores</x-slot>


    <div class="page-header">
        <h1>Proveedores</h1>
    </div>
    <div class="table-container">
        <div class="table-toolbar">
            <form action="{{ url()->current() }}" method="GET" class="search-wrapper">
                <i class="ti ti-search search-icon"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o ID...">
            </form>
            <button class="btn-primary" >
                <i class="ti ti-plus"></i> Nuevo Proveedeor
            </button>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ubicacion</th>
                        <th>Tipo</th>
                        <th>Creado</th>
                        <th>Estado</th>
                        <th style="text-align:center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->id_supplier }}</td>
                            <td>
                                    <div class="client-name">{{ $proveedor->supplier_name }}</div>
                            </td>
                            <td>{{ $proveedor->id_categories_suppliers ?? '---' }}</td>
                            <td>{{ $proveedor->id_destinations ?? 'Sin asignar' }}</td>
                            <td>{{ $proveedor->created_at ?? 'Sin registrar' }}</td>
                            <td>
                                <span class="status-badge {{ ($cliente->status ?? 'activo') === 'activo' ? 'status-active' : 'status-inactive' }}">
                                    {{ ucfirst($proveedor->status ?? 'activo') }}
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="" class="btn-action btn-edit" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form  method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este cliente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Eliminar">
                                           <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; color:#888; padding:2.5rem;">
                                <i class="ti ti-database-off" style="font-size:26px; display:block; margin-bottom:8px; color:#94a3b8;"></i>
                                No hay clientes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            {{ $proveedores->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
        </div>
    </div>

</x-layout>