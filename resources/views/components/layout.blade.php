<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'ERP - Fiesta Tours' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard_layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
   

</head>
<body>
    <div class="dashboard-layout">

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <a href="/" class="brand-logo-wrap">
                    <img src="{{ asset('images/Logo-FTI-port-black.png') }}" class="logo_layout" alt="Fiesta Tours">
                </a>
                <button class="sidebar-toggle" id="sidebarToggle" title="Contraer menú">
                    <span class="logo-icon">FT</span>
                </button>
            </div>

            <div class="container-nav">
                <div>
                    <div class="nav-group">
                        <span class="nav-group-label">General</span>
                        <nav class="sidebar-links">
                            <a href="/dashboard" class="active" data-tip="Dashboard">
                                <i class="bi bi-grid-1x2"></i>
                                <span class="link-text">Dashboard</span>
                            </a>
                          
                        </nav>
                    </div>

                    <div class="nav-divider"></div>

                    <div class="nav-group">
                        <span class="nav-group-label">Gestión</span>
                        <nav class="sidebar-links">
                            <a href="/clientes" data-tip="Clientes">
                                <i class="bi bi-people"></i>
                                <span class="link-text">Clientes</span>
                            </a>
                            <a href="/proveedores" data-tip="Proveedores">
                                <i class="bi bi-truck"></i>
                                <span class="link-text">Proveedores</span>
                            </a>
                        </nav>
                    </div>

                    @role('admin')
                    <div class="nav-divider"></div>
                    <div class="nav-group">
                        <span class="nav-group-label">Administración</span>
                        <nav class="sidebar-links">
                            <a href="/users" data-tip="Usuarios">
                               <i class="bi bi-people"></i>
                                <span class="link-text">Usuarios</span>
                            </a>
                        </nav>
                    </div>
                    @endrole
                </div>

                <div class="container-user__signout">
                    <div class="container-user__signout--content">
                        <div class="container-user__signout--content_feature">
                            <div class="avatar-wrap">
                                <img class="container-user__signout--content-avatar-img"
                                    src="{{ auth()->user()->profile->avatar_url ?? 'https://res.cloudinary.com/dlgeap8h0/image/upload/v1778193409/main-sample.png' }}"
                                    alt="Avatar">
                                <span class="avatar-status"></span>
                            </div>
                            <div class="container-user_names">
                                <p class="span-layout_text_username">{{ auth()->user()->name }}</p>
                                <span class="span-layout_text_userlastname">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="container-user__signout--content-link" title="Cerrar Sesión">
                                <i class="bi bi-box-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="container-header__subnav">
                <div class="subnav-left">
                    <button class="toggle-btn-header" id="toggleBtnHeader" title="Expandir/Contraer menú">
                        <i class="bi bi-layout-sidebar"></i>
                    </button>
                   
                </div>
                
                <div class="subnav-right">
                    <button class="subnav-icon-btn" title="Notificaciones">
                        <i class="bi bi-bell"></i>
                        <span class="notif-dot"></span>
                    </button>
                        <div class="container-user__signout--content_feature">
                            <div class="avatar-wrap">
                                <img class="container-user__signout--content-avatar-img"
                                    src="{{ auth()->user()->profile->avatar_url ?? 'https://res.cloudinary.com/dlgeap8h0/image/upload/v1778193409/main-sample.png' }}"
                                    alt="Avatar">
                                <span class="avatar-status"></span>
                            </div>
                            <div class="container-user_names">
                                <p class="span-layout_text_username span--feature_header">{{ auth()->user()->name }}</p>
                                <span class="span-layout_text_userlastname span-feature_header"> {{ auth()->user()->getRoleNames()->first()  }}</span>
                            </div>
                            <button class="subnav-gear-btn" title="Configuración">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </div>
               
                </div>
            </header>

            <div class="slot-wrapper">
                {{ $slot }}
            </div>
        </main>

    </div>

    <script>
        (function () {
            const STORAGE_KEY = 'erp_sidebar_collapsed';
            const sidebar = document.getElementById('sidebar');
            const toggleInner = document.getElementById('sidebarToggle');
            const toggleHeader = document.getElementById('toggleBtnHeader');

            if (localStorage.getItem(STORAGE_KEY) === 'true') {
                sidebar.classList.add('collapsed');
            }

            function toggle() {
                const isCollapsed = sidebar.classList.toggle('collapsed');
                localStorage.setItem(STORAGE_KEY, isCollapsed);
            }

            toggleInner.addEventListener('click', toggle);
            toggleHeader.addEventListener('click', toggle);
        })();
    </script>


    <script src="https://unpkg.com/@hotwired/turbo@8.0.5/dist/turbo.es2017-umd.js" defer></script>

</body>
</html>