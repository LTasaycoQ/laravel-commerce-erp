<x-layout>
    <x-slot name="title">Dashboard - Clientes</x-slot>


    <div class="page-header">
        <h1>Clientes</h1>
    </div>

    <div class="table-container">
        <div class="table-toolbar">
            <form action="{{ url()->current() }}" method="GET" class="search-wrapper">
                <i class="ti ti-search search-icon"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o ID...">
            </form>
            <button class="btn-primary" onclick="abrirModal()">
                <i class="ti ti-plus"></i> Nuevo Cliente
            </button>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente / Empresa</th>
                        <th>RUC / DNI</th>
                        <th>Contacto Principal</th>
                        <th>Destino Preferido</th>
                        <th>Estado</th>
                        <th style="text-align:center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id_client }}</td>
                            <td>
                                <div>
                                    <div class="client-name">{{ $cliente->name_client }}</div>
                                    <div class="client-type">{{ $cliente->tipo_cliente ?? 'Agencia Asociada' }}</div>
                                </div>
                            </td>
                            <td>{{ $cliente->documento ?? '---' }}</td>
                            <td>{{ $cliente->telefono ?? 'Sin asignar' }}</td>
                            <td><span class="badge-destination">{{ $cliente->destino_preferido ?? 'No asignado' }}</span></td>
                            <td>
                                <span class="status-badge {{ ($cliente->status ?? 'activo') === 'activo' ? 'status-active' : 'status-inactive' }}">
                                    {{ ucfirst($cliente->status ?? 'activo') }}
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ url('/clientes/'.($cliente->id_client ?? $cliente->id).'/editar') }}" class="btn-action btn-edit" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ url('/clientes/'.($cliente->id_client ?? $cliente->id)) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este cliente?')">
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
            {{ $clientes->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="modal-overlay" id="modalCliente" onclick="cerrarModalFuera(event)">
        <div class="modal-box">
            <div class="modal-header">
                <h3><i class="ti ti-building"></i> Registrar Nuevo Cliente</h3>
                <button class="modal-close" onclick="cerrarModal()"><i class="bi bi-x-lg"></i></button>
            </div>

            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <p class="section-label"><i class="ti ti-building"></i> Datos de la Empresa</p>
                    <div class="form-group">
                        <label for="name_client">Nombre de la Empresa / Cliente Corporativo</label>
                        <input type="text" id="name_client" name="name_client" class="form-control-custom" placeholder="Ej: Fiesta Tours Perú S.A.C." required>
                    </div>

                    <p class="section-label" style="margin-top:1.5rem;"><i class="ti ti-users"></i> Contactos</p>

                    <div id="contenedor-contactos">
                        <div class="contacto-item">
                            <div class="contacto-item-header">
                                <span><i class="ti ti-user-star"></i> Contacto #1 — Representante Principal</span>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Nombre *</label>
                                    <input type="text" name="contactos[0][name]" class="form-control-custom" placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input type="text" name="contactos[0][last_names]" class="form-control-custom" placeholder="Apellidos">
                                </div>
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input type="email" name="contactos[0][email]" class="form-control-custom" placeholder="ejemplo@correo.com">
                                </div>
                                <div class="form-group">
                                    <label>Teléfono 1</label>
                                    <input type="text" name="contactos[0][first_phone]" class="form-control-custom" placeholder="Principal">
                                </div>
                                <div class="form-group">
                                    <label>Teléfono 2</label>
                                    <input type="text" name="contactos[0][second_phone]" class="form-control-custom" placeholder="Opcional">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-success-sm" onclick="añadirContacto()">
                        <i class="ti ti-user-plus"></i> Añadir contacto
                    </button>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="cerrarModal()">Cancelar</button>
                    <button type="submit" class="btn-submit">
                        <i class="ti ti-device-floppy"></i> Guardar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let contadorContactos = 1;

        function abrirModal() {
            document.getElementById('modalCliente').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function cerrarModal() {
            document.getElementById('modalCliente').classList.remove('open');
            document.body.style.overflow = '';
        }

        function cerrarModalFuera(e) {
            if (e.target === document.getElementById('modalCliente')) cerrarModal();
        }

        function añadirContacto() {
            const contenedor = document.getElementById('contenedor-contactos');
            const idx = contadorContactos;
            const div = document.createElement('div');
            div.className = 'contacto-item';
            div.innerHTML = `
                <div class="contacto-item-header">
                    <span><i class="ti ti-user"></i> Contacto #${idx + 1}</span>
                    <button type="button" class="btn-danger-sm" onclick="this.closest('.contacto-item').remove()">
                        <i class="ti ti-trash"></i> Eliminar
                    </button>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nombre *</label>
                        <input type="text" name="contactos[${idx}][name]" class="form-control-custom" placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="contactos[${idx}][last_names]" class="form-control-custom" placeholder="Apellidos">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="contactos[${idx}][email]" class="form-control-custom" placeholder="ejemplo@correo.com">
                    </div>
                    <div class="form-group">
                        <label>Teléfono 1</label>
                        <input type="text" name="contactos[${idx}][first_phone]" class="form-control-custom" placeholder="Principal">
                    </div>
                    <div class="form-group">
                        <label>Teléfono 2</label>
                        <input type="text" name="contactos[${idx}][second_phone]" class="form-control-custom" placeholder="Opcional">
                    </div>
                </div>
            `;
            contenedor.appendChild(div);
            contadorContactos++;
        }

        document.addEventListener('keydown', e => { if (e.key === 'Escape') cerrarModal(); });
    </script>
</x-layout>