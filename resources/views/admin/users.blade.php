<x-layout>
    <x-slot name="title">Lista Usuarios</x-slot>
    
    <h1>Administración de Usuarios</h1>

   <style>
    .form-design{
        display:flex;
        gap: 20px;
    }
    .containe--feature{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:30px;
    }

    .container-dashboar_user{
        display:flex;
        flex-wrap:wrap;
    }
    .container-card{
        display:flex;
        width:200px;
        background-color:white;
        border-radius:10px;
        flex-direction:column;
        gap:10px;
        padding:1rem;
    }
    .title_dashboard-user{
        font-size:15px;
        font-weight:800;
        text-transform:uppercase;
    }
    .text-resulado{
        font-weight:900;
    }
   </style> 
    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="container-dashboar_user">
        <div class="container-card">
            <h4 class="title_dashboard-user">Registrados</h4>
            <span class="text-resulado">4</span>
        </div>
    </div>

    <div class="table-container">
        <div class="search-box-container containe--feature mb-4">
            <form action="{{ url('/users') }}" method="GET" class="form-design">
                <div class="search-wrapper flex-grow-1" style="position: relative;">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por ID, nombre o correo..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
                @if(request('search'))
                    <a href="{{ url('/users') }}" class="btn btn-primary">Limpiar</a>
                @endif
            </form>
            <button type="button" onclick="abrirModal()" class="btn btn-primary">Nuevo Usuario</button>

        
         </div>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Usuario / Información</th>
                        <th>Rol Asignado</th>
                        <th>Fecha de Registro</th>
                        <th style="text-align:center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class='container-perfil'>
                                <div class="avatar-wrap">
                                <img class="container-user__signout--content-avatar-img"
                                    src="{{ auth()->user()->profile->avatar_url ?? 'https://i.pinimg.com/736x/19/b6/05/19b605a7f846d3555a85927917162576.jpg' }}"
                                    alt="Avatar">
                            </div>
                                <div>
                                    <div class="client-name">{{ $user->name }}</div>
                                    <div class="client-type" style="color: #64748b; font-size: 12px;">{{ $user->email }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-destination">
                                    {{ strtoupper($user->getRoleNames()->first() ?? 'Sin Rol') }}
                                </span>
                            </td>
                            <td>
                                <span style="font-size: 13px; color: #475569;">
                                    {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : '---' }}
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ url('/admin/users/'.$user->id.'/editar') }}" class="btn-action btn-edit" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    <form action="{{ url('/admin/users/'.$user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar a este usuario del sistema?')">
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
                            <td colspan="5" style="text-align:center; color:#888; padding:2.5rem;">
                                <i class="bi bi-database-down" style="font-size:26px; display:block; margin-bottom:8px; color:#94a3b8;"></i>
                                No hay usuarios registrados con esos criterios.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-container mt-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="modal-overlay" id="modalUsuario" onclick="cerrarModalFuera(event)">
        <div class="modal-box">
            <div class="modal-header">
                <h3><i class="bi bi-person-plus"></i> Registrar Usuario</h3>
                <button class="modal-close" onclick="cerrarModal()"><i class="bi bi-x"></i></button>
            </div>
            <form action="{{ url('/admin/users') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" name="name" id="name" class="form-control-custom" placeholder="Ej: Juan Pérez" required value="{{ old('name') }}">
                        @error('name') <span class="text-danger-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control-custom" placeholder="ejemplo@fiestatoursperu.com" required value="{{ old('email') }}">
                        @error('email') <span class="text-danger-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control-custom" placeholder="Mínimo 6 caracteres" required>
                        @error('password') <span class="text-danger-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Rol del Sistema</label>
                        <select name="role" id="role" class="form-control-custom" required>
                            <option value="" disabled selected>Selecciona un rol...</option>
                            <option value="user"  {{ old('role') == 'user'  ? 'selected' : '' }}>Usuario</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('role') <span class="text-danger-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="cerrarModal()">Cancelar</button>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-floppy"></i> Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function abrirModal() {
            document.getElementById('modalUsuario').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function cerrarModal() {
            document.getElementById('modalUsuario').classList.remove('open');
            document.body.style.overflow = '';
        }
        function cerrarModalFuera(e) {
            if (e.target === document.getElementById('modalUsuario')) cerrarModal();
        }
        document.addEventListener('keydown', e => { if (e.key === 'Escape') cerrarModal(); });

        @if($errors->any())
            document.addEventListener('DOMContentLoaded', () => abrirModal());
        @endif
    </script>

</x-layout>