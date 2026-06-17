{{-- resources/views/products/dashboard.blade.php --}}
<x-layout>
<x-slot name="title">Dashboard</x-slot>

@push('styles')
<style>
/* ═══════════════════════════════════════════
   TOKENS
═══════════════════════════════════════════ */
:root {
    --ink:        #0f172a;
    --ink-2:      #334155;
    --ink-3:      #64748b;
    --muted:      #94a3b8;
    --surface:    #f8fafc;
    --card:       #ffffff;
    --border:     #e2e8f0;
    --accent:     #3b82f6;
    --accent-lt:  #eff6ff;
    --green:      #10b981;
    --green-lt:   #ecfdf5;
    --red:        #e63232;
    --red-lt:     #fef2f2;
    --amber:      #f59e0b;
    --amber-lt:   #fffbeb;
    --purple:     #7c3aed;
    --purple-lt:  #f5f3ff;
    --teal:       #0d9488;
    --teal-lt:    #f0fdfa;
}

/* ═══════════════════════════════════════════
   SHARED BASE
═══════════════════════════════════════════ */
.db                { display:flex; flex-direction:column; gap:1.6rem; padding-bottom:2.5rem; }

/* Header */
.db-head           { display:flex; align-items:flex-start; justify-content:space-between;
                     gap:1rem; flex-wrap:wrap; }
.db-title          { font-size:1.65rem; font-weight:800; color:var(--ink);
                     letter-spacing:-.03em; line-height:1.1; }
.db-title em       { font-style:normal; color:var(--red); }
.db-sub            { font-size:.8rem; color:var(--muted); margin-top:.3rem; }
.db-acts           { display:flex; gap:.6rem; align-items:center; flex-wrap:wrap; }

/* Time tabs */
.time-tabs         { display:inline-flex; background:var(--surface); border:1px solid var(--border);
                     border-radius:10px; padding:3px; gap:2px; }
.time-tab          { padding:5px 16px; font-size:.75rem; font-weight:600; color:var(--ink-3);
                     border:none; background:transparent; border-radius:8px;
                     cursor:pointer; transition:all .15s; }
.time-tab.active   { background:#fff; color:var(--ink);
                     box-shadow:0 1px 4px rgba(0,0,0,.09); }

/* Buttons */
.btn               { display:inline-flex; align-items:center; gap:.4rem; padding:.45rem .95rem;
                     border-radius:8px; font-size:.8rem; font-weight:600; cursor:pointer;
                     text-decoration:none; border:none; transition:all .18s; }
.btn-primary       { background:var(--red); color:#fff; }
.btn-primary:hover { background:#c82020; }
.btn-ghost         { background:#fff; color:var(--ink-2); border:1px solid var(--border); }
.btn-ghost:hover   { border-color:#94a3b8; }
.btn-sm            { padding:.35rem .8rem; font-size:.75rem; }

/* KPI grid — FIXED 4 columns */
.kpi-grid          { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; }
.kpi               { background:var(--card); border:1px solid var(--border); border-radius:14px;
                     padding:1.3rem 1.4rem; position:relative; overflow:hidden;
                     transition:box-shadow .2s, transform .2s; }
.kpi:hover         { box-shadow:0 8px 24px rgba(0,0,0,.08); transform:translateY(-2px); }
.kpi.dark          { background:linear-gradient(135deg,#0f172a 60%,#1e293b); border-color:transparent; }
.kpi-blob          { position:absolute; right:-18px; top:-18px; width:80px; height:80px;
                     border-radius:50%; opacity:.08; }
.kpi-ico           { width:38px; height:38px; border-radius:10px; display:flex;
                     align-items:center; justify-content:center; font-size:1.1rem;
                     margin-bottom:.9rem; }
.kpi-lbl           { font-size:.68rem; font-weight:700; text-transform:uppercase;
                     letter-spacing:.08em; color:var(--muted); }
.kpi.dark .kpi-lbl { color:rgba(255,255,255,.45); }
.kpi-val           { font-size:2.1rem; font-weight:900; color:var(--ink);
                     line-height:1; letter-spacing:-.04em; margin:.2rem 0; }
.kpi.dark .kpi-val { color:#fff; }
.kpi-note          { font-size:.73rem; color:var(--muted); }
.kpi.dark .kpi-note{ color:rgba(255,255,255,.35); }
.kpi-delta         { display:inline-flex; align-items:center; gap:3px;
                     font-size:.73rem; font-weight:700; padding:2px 8px;
                     border-radius:6px; margin-top:.35rem; }
.delta-up          { background:var(--green-lt); color:#065f46; }
.delta-dn          { background:var(--red-lt); color:#991b1b; }
.delta-dark-up     { background:rgba(34,197,94,.15); color:#4ade80; }

/* Panel card */
.panel             { background:var(--card); border:1px solid var(--border); border-radius:14px;
                     overflow:hidden; }
.panel-head        { display:flex; align-items:center; justify-content:space-between;
                     padding:1rem 1.35rem; border-bottom:1px solid var(--surface); }
.panel-title       { font-size:.88rem; font-weight:700; color:var(--ink); }
.panel-sub         { font-size:.72rem; color:var(--muted); margin-top:1px; }
.panel-body        { padding:1.2rem 1.35rem; }
.panel-link        { font-size:.75rem; font-weight:600; color:var(--accent); text-decoration:none; }
.panel-link:hover  { text-decoration:underline; }

/* Row list */
.row-list          { display:flex; flex-direction:column; }
.row-item          { display:flex; align-items:center; gap:.75rem;
                     padding:.7rem 1.35rem; border-bottom:1px solid #f8fafc;
                     text-decoration:none; transition:background .15s; }
.row-item:last-child { border-bottom:none; }
.row-item:hover    { background:var(--surface); }
.ri-av             { width:36px; height:36px; border-radius:9px; flex-shrink:0;
                     display:flex; align-items:center; justify-content:center;
                     font-size:.7rem; font-weight:800; }
.ri-name           { font-size:.82rem; font-weight:600; color:var(--ink); }
.ri-meta           { font-size:.71rem; color:var(--muted); }
.ri-badge          { margin-left:auto; padding:2px 9px; border-radius:999px;
                     font-size:.65rem; font-weight:700; text-transform:uppercase;
                     letter-spacing:.04em; }
.badge-admin       { background:var(--purple-lt); color:var(--purple); }
.badge-user        { background:var(--green-lt); color:#065f46; }
.badge-active      { background:var(--green-lt); color:#065f46; }

/* Bar chart */
.chart-bars        { display:flex; align-items:flex-end; gap:5px;
                     height:110px; padding-bottom:6px;
                     border-bottom:1px solid var(--surface); margin-bottom:.8rem; }
.bar-col           { flex:1; display:flex; flex-direction:column; align-items:center; gap:3px; }
.bar-inner         { width:100%; border-radius:5px 5px 0 0; background:var(--border);
                     min-height:4px; transition:background .2s; }
.bar-inner.hi      { background:linear-gradient(to top,var(--red),#ff6b6b); }
.bar-lbl           { font-size:10px; color:var(--muted); font-weight:600; }
.chart-legend      { display:flex; gap:1rem; font-size:.73rem; color:var(--muted); }
.leg-dot           { width:8px; height:8px; border-radius:50%;
                     display:inline-block; margin-right:3px; }

/* Role distribution */
.role-bars         { display:flex; flex-direction:column; gap:.9rem; }
.rb-top            { display:flex; justify-content:space-between;
                     font-size:.78rem; margin-bottom:4px; }
.rb-label          { font-weight:600; color:var(--ink); }
.rb-pct            { color:var(--muted); font-weight:600; }
.rb-track          { height:7px; background:var(--surface); border-radius:999px; overflow:hidden; }
.rb-fill           { height:100%; border-radius:999px; transition:width .6s ease; }

/* Quick actions */
.qa-grid           { display:grid; grid-template-columns:1fr 1fr; gap:.65rem; }
.qa-card           { background:var(--surface); border:1px solid var(--border);
                     border-radius:10px; padding:.9rem 1rem; text-decoration:none;
                     display:block; transition:all .15s; }
.qa-card:hover     { background:#fff; border-color:#c7d2fe;
                     box-shadow:0 4px 12px rgba(0,0,0,.07); transform:translateY(-1px); }
.qa-icon           { font-size:20px; margin-bottom:.35rem; }
.qa-name           { font-size:.8rem; font-weight:700; color:var(--ink); }
.qa-desc           { font-size:.7rem; color:var(--muted); margin-top:1px; }

/* Account info */
.account-rows      { display:flex; flex-direction:column; gap:0; }
.acc-row           { display:flex; align-items:center; gap:.75rem;
                     padding:.6rem 0; border-bottom:1px solid var(--surface);
                     font-size:.82rem; }
.acc-row:last-child{ border-bottom:none; }
.acc-icon          { color:var(--muted); width:18px; text-align:center; flex-shrink:0; }
.acc-label         { color:var(--ink-3); width:105px; flex-shrink:0; }
.acc-val           { font-weight:600; color:var(--ink); }

/* Grids */
.two-col           { display:grid; grid-template-columns:1fr 330px; gap:1rem; }
.two-eq            { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }

/* Responsive */
@media(max-width:1100px){ .kpi-grid { grid-template-columns:repeat(2,1fr); } }
@media(max-width:960px) { .two-col  { grid-template-columns:1fr; } }
@media(max-width:700px) { .two-eq   { grid-template-columns:1fr; }
                          .kpi-grid { grid-template-columns:1fr; } }
</style>
@endpush

@php
    $user      = auth()->user();
    $isAdmin   = $user->hasRole('admin');
    $firstName = explode(' ', $user->name)[0];
@endphp

<div class="db">

{{-- ════════════════════════════════════════
     HEADER  (compartido)
════════════════════════════════════════ --}}
<div class="db-head">
    <div>
        <div class="db-title">Bienvenido, <em>{{ $firstName }}</em> 👋</div>
        <div class="db-sub">
            {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
            &middot; {{ $isAdmin ? 'Panel de administración' : 'Panel de control' }}
        </div>
    </div>

    @if($isAdmin)
    <div class="db-acts">
        <div class="time-tabs">
            <button class="time-tab">Día</button>
            <button class="time-tab">Semana</button>
            <button class="time-tab active">Mes</button>
            <button class="time-tab">Año</button>
        </div>
        <a href="{{ route('admin.users') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-person-plus"></i> Nuevo usuario
        </a>
    </div>
    @endif
</div>


{{-- ════════════════════════════════════════
     ADMIN VIEW
════════════════════════════════════════ --}}
@if($isAdmin)

{{-- KPIs --}}
<div class="kpi-grid">

    {{-- Total --}}
    <div class="kpi dark">
        <div class="kpi-blob" style="background:#818cf8"></div>
        <div class="kpi-ico" style="background:rgba(99,102,241,.2)">
            <i class="bi bi-people" style="color:#a5b4fc"></i>
        </div>
        <div class="kpi-lbl">Usuarios totales</div>
        <div class="kpi-val">{{ $totalUsers }}</div>
        <span class="kpi-delta delta-dark-up">
            <i class="bi bi-arrow-up-right" style="font-size:10px"></i> 12% vs mes pasado
        </span>
    </div>

    {{-- Activos --}}
    <div class="kpi">
        <div class="kpi-blob" style="background:var(--green)"></div>
        <div class="kpi-ico" style="background:var(--green-lt)">
            <i class="bi bi-person-check" style="color:var(--green)"></i>
        </div>
        <div class="kpi-lbl">Usuarios activos</div>
        <div class="kpi-val">{{ $activeUsers }}</div>
        <span class="kpi-delta delta-up">
            <i class="bi bi-arrow-up-right" style="font-size:10px"></i> {{ $newThisMonth }} nuevos este mes
        </span>
    </div>

    {{-- Admins --}}
    <div class="kpi">
        <div class="kpi-blob" style="background:var(--purple)"></div>
        <div class="kpi-ico" style="background:var(--purple-lt)">
            <i class="bi bi-shield-check" style="color:var(--purple)"></i>
        </div>
        <div class="kpi-lbl">Administradores</div>
        <div class="kpi-val">{{ $adminCount }}</div>
        <div class="kpi-note">Con acceso total</div>
    </div>

    {{-- Nuevos hoy --}}
    <div class="kpi">
        <div class="kpi-blob" style="background:var(--amber)"></div>
        <div class="kpi-ico" style="background:var(--amber-lt)">
            <i class="bi bi-person-plus" style="color:var(--amber)"></i>
        </div>
        <div class="kpi-lbl">Nuevos hoy</div>
        <div class="kpi-val">{{ $newToday }}</div>
        <span class="kpi-delta delta-dn">
            <i class="bi bi-arrow-down-right" style="font-size:10px"></i> 1 vs ayer
        </span>
    </div>

</div>

{{-- Chart + Usuarios recientes --}}
<div class="two-col">

    <div class="panel">
        <div class="panel-head">
            <div>
                <div class="panel-title">Actividad de usuarios</div>
                <div class="panel-sub">Últimos 12 meses</div>
            </div>
            <a href="{{ route('admin.users') }}" class="panel-link">Ver más</a>
        </div>
        <div class="panel-body">
            @php
                $months   = ['E','F','M','A','M','J','J','A','S','O','N','D'];
                $bars     = [20,38,30,55,42,70,48,80,38,65,75,58];
                $curMonth = now()->month - 1;
            @endphp
            <div class="chart-bars">
                @foreach($months as $i => $m)
                <div class="bar-col">
                    <div class="bar-inner {{ $i === $curMonth ? 'hi' : '' }}"
                         style="height:{{ $bars[$i] }}%"></div>
                    <div class="bar-lbl">{{ $m }}</div>
                </div>
                @endforeach
            </div>
            <div class="chart-legend">
                <span><span class="leg-dot" style="background:var(--red)"></span>Registros</span>
                <span><span class="leg-dot" style="background:var(--border)"></span>Meses anteriores</span>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <div>
                <div class="panel-title">Usuarios recientes</div>
                <div class="panel-sub">Últimos registros</div>
            </div>
            <a href="{{ route('admin.users') }}" class="panel-link">Ver todos</a>
        </div>
        <div class="row-list">
            @forelse($recentUsers as $u)
            <div class="row-item">
                <div class="ri-av"
                     style="background:{{ $u->hasRole('admin') ? 'var(--purple-lt)' : 'var(--green-lt)' }};
                            color:{{ $u->hasRole('admin') ? 'var(--purple)' : '#065f46' }}">
                    {{ strtoupper(substr($u->name,0,2)) }}
                </div>
                <div>
                    <div class="ri-name">{{ $u->name }}</div>
                    <div class="ri-meta">{{ $u->email }}</div>
                </div>
                <span class="ri-badge {{ $u->hasRole('admin') ? 'badge-admin' : 'badge-user' }}">
                    {{ $u->hasRole('admin') ? 'Admin' : 'Usuario' }}
                </span>
            </div>
            @empty
            <div style="padding:1.5rem;text-align:center;color:var(--muted);font-size:.82rem">
                Sin usuarios registrados aún.
            </div>
            @endforelse
        </div>
    </div>

</div>

{{-- Roles + accesos rápidos --}}
<div class="two-eq">

    <div class="panel">
        <div class="panel-head">
            <div>
                <div class="panel-title">Distribución de roles</div>
                <div class="panel-sub">Estado actual</div>
            </div>
        </div>
        <div class="panel-body">
            @php
                $t       = max($totalUsers, 1);
                $uPct    = round(($totalUsers - $adminCount) / $t * 100);
                $aPct    = round($adminCount / $t * 100);
                $newPct  = round($newThisMonth / $t * 100);
            @endphp
            <div class="role-bars">
                <div>
                    <div class="rb-top">
                        <span class="rb-label">Usuarios</span>
                        <span class="rb-pct">{{ $uPct }}%</span>
                    </div>
                    <div class="rb-track">
                        <div class="rb-fill" style="width:{{ $uPct }}%;background:linear-gradient(90deg,#6366f1,#818cf8)"></div>
                    </div>
                </div>
                <div>
                    <div class="rb-top">
                        <span class="rb-label">Admins</span>
                        <span class="rb-pct">{{ $aPct }}%</span>
                    </div>
                    <div class="rb-track">
                        <div class="rb-fill" style="width:{{ $aPct }}%;background:linear-gradient(90deg,var(--red),#ff6b6b)"></div>
                    </div>
                </div>
                <div>
                    <div class="rb-top">
                        <span class="rb-label">Nuevos este mes</span>
                        <span class="rb-pct">{{ $newPct }}%</span>
                    </div>
                    <div class="rb-track">
                        <div class="rb-fill" style="width:{{ $newPct }}%;background:linear-gradient(90deg,var(--green),#34d399)"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <div>
                <div class="panel-title">Accesos rápidos</div>
                <div class="panel-sub">Atajos del sistema</div>
            </div>
        </div>
        <div style="padding:1.2rem 1.35rem">
            <div class="qa-grid">
                <a href="{{ route('admin.users') }}" class="qa-card">
                    <div class="qa-icon">👤</div>
                    <div class="qa-name">Crear usuario</div>
                    <div class="qa-desc">Agregar nuevo</div>
                </a>
                <a href="{{ route('admin.users') }}" class="qa-card">
                    <div class="qa-icon">👥</div>
                    <div class="qa-name">Ver usuarios</div>
                    <div class="qa-desc">Gestionar todos</div>
                </a>
                <a href="{{ route('clientes.index') }}" class="qa-card">
                    <div class="qa-icon">🏢</div>
                    <div class="qa-name">Clientes</div>
                    <div class="qa-desc">Ver todos</div>
                </a>
                <a href="{{ route('proveedores.index') }}" class="qa-card">
                    <div class="qa-icon">🚌</div>
                    <div class="qa-name">Proveedores</div>
                    <div class="qa-desc">Gestionar</div>
                </a>
            </div>
        </div>
    </div>

</div>


{{-- ════════════════════════════════════════
     USUARIO VIEW
════════════════════════════════════════ --}}
@else

{{-- KPIs --}}
<div class="kpi-grid">

    <div class="kpi dark">
        <div class="kpi-blob" style="background:#818cf8"></div>
        <div class="kpi-ico" style="background:rgba(99,102,241,.2)">
            <i class="bi bi-building" style="color:#a5b4fc"></i>
        </div>
        <div class="kpi-lbl">Clientes</div>
        <div class="kpi-val">{{ $totalClientes }}</div>
        <div class="kpi-note">Empresas registradas</div>
    </div>

    <div class="kpi">
        <div class="kpi-blob" style="background:var(--green)"></div>
        <div class="kpi-ico" style="background:var(--green-lt)">
            <i class="bi bi-person-lines-fill" style="color:var(--green)"></i>
        </div>
        <div class="kpi-lbl">Contactos</div>
        <div class="kpi-val">{{ $totalContactos }}</div>
        <div class="kpi-note">En total</div>
    </div>

    <div class="kpi">
        <div class="kpi-blob" style="background:var(--amber)"></div>
        <div class="kpi-ico" style="background:var(--amber-lt)">
            <i class="bi bi-truck" style="color:var(--amber)"></i>
        </div>
        <div class="kpi-lbl">Proveedores</div>
        <div class="kpi-val">{{ $totalProveedores }}</div>
        <div class="kpi-note">Registrados</div>
    </div>

    <div class="kpi">
        <div class="kpi-blob" style="background:var(--teal)"></div>
        <div class="kpi-ico" style="background:var(--teal-lt)">
            <i class="bi bi-geo-alt" style="color:var(--teal)"></i>
        </div>
        <div class="kpi-lbl">Destinos</div>
        <div class="kpi-val">{{ $totalDestinos }}</div>
        <div class="kpi-note">Disponibles</div>
    </div>

</div>

{{-- Clientes recientes + Mi cuenta --}}
<div class="two-col">

    <div class="panel">
        <div class="panel-head">
            <div>
                <div class="panel-title">Clientes recientes</div>
                <div class="panel-sub">Últimos registrados</div>
            </div>
            <a href="{{ route('clientes.index') }}" class="panel-link">Ver todos</a>
        </div>
        <div class="row-list">
            @forelse($recentClientes as $c)
            <a href="{{ route('clientes.index') }}" class="row-item">
                <div class="ri-av" style="background:#dbeafe;color:#1d4ed8">
                    {{ strtoupper(substr($c->name_client,0,2)) }}
                </div>
                <div>
                    <div class="ri-name">{{ $c->name_client }}</div>
                    <div class="ri-meta">{{ $c->contactos->count() }} contacto(s)</div>
                </div>
                <span class="ri-badge badge-active">ACTIVO</span>
            </a>
            @empty
            <div style="padding:1.5rem;text-align:center;color:var(--muted);font-size:.82rem">
                No hay clientes registrados aún.
            </div>
            @endforelse
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <div>
                <div class="panel-title">Mi cuenta</div>
                <div class="panel-sub">Información personal</div>
            </div>
            <a href="#" class="btn btn-ghost btn-sm">
                <i class="bi bi-pencil" style="font-size:11px"></i> Editar
            </a>
        </div>
        <div class="panel-body">
            <div class="account-rows">
                <div class="acc-row">
                    <i class="bi bi-person acc-icon"></i>
                    <span class="acc-label">Nombre</span>
                    <span class="acc-val">{{ $user->name }}</span>
                </div>
                <div class="acc-row">
                    <i class="bi bi-envelope acc-icon"></i>
                    <span class="acc-label">Correo</span>
                    <span class="acc-val" style="font-size:.75rem">{{ $user->email }}</span>
                </div>
                <div class="acc-row">
                    <i class="bi bi-calendar3 acc-icon"></i>
                    <span class="acc-label">Miembro desde</span>
                    <span class="acc-val">{{ $user->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Proveedores + accesos rápidos --}}
<div class="two-eq">

    <div class="panel">
        <div class="panel-head">
            <div>
                <div class="panel-title">Proveedores recientes</div>
                <div class="panel-sub">Últimos registrados</div>
            </div>
            <a href="{{ route('proveedores.index') }}" class="panel-link">Ver todos</a>
        </div>
        <div class="row-list">
            @forelse($recentProveedores as $p)
            <a href="{{ route('proveedores.index') }}" class="row-item">
                <div class="ri-av" style="background:var(--teal-lt);color:var(--teal)">
                    {{ strtoupper(substr($p->supplier_name,0,2)) }}
                </div>
                <div>
                    <div class="ri-name">{{ $p->supplier_name }}</div>
                    <div class="ri-meta">
                        {{ $p->destino->destination_name ?? 'Sin destino' }}
                        @isset($p->categoria) &middot; {{ $p->categoria->category_name }} @endisset
                    </div>
                </div>
            </a>
            @empty
            <div style="padding:1.5rem;text-align:center;color:var(--muted);font-size:.82rem">
                No hay proveedores registrados aún.
            </div>
            @endforelse
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <div>
                <div class="panel-title">Accesos rápidos</div>
                <div class="panel-sub">Atajos del sistema</div>
            </div>
        </div>
        <div style="padding:1.2rem 1.35rem">
            <div class="qa-grid">
                <a href="{{ route('clientes.index') }}" class="qa-card">
                    <div class="qa-icon">🏢</div>
                    <div class="qa-name">Clientes</div>
                    <div class="qa-desc">Ver todos</div>
                </a>
                <a href="{{ route('clientes.index') }}" class="qa-card">
                    <div class="qa-icon">📞</div>
                    <div class="qa-name">Contactos</div>
                    <div class="qa-desc">Gestionar</div>
                </a>
                <a href="{{ route('proveedores.index') }}" class="qa-card">
                    <div class="qa-icon">🚌</div>
                    <div class="qa-name">Proveedores</div>
                    <div class="qa-desc">Ver todos</div>
                </a>
                <a href="#" class="qa-card">
                    <div class="qa-icon">🪪</div>
                    <div class="qa-name">Mi perfil</div>
                    <div class="qa-desc">Ver mis datos</div>
                </a>
            </div>
        </div>
    </div>

</div>

@endif
{{-- fin @if($isAdmin) --}}

</div>
{{-- fin .db --}}

</x-layout>
