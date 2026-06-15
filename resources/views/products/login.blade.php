<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">    
    <title>Login - Fiesta Tours Peru</title>
</head>
<body>

    <main class="container_form">
        <div class="login-wrap">

            <div class="login-img">
                <div class="login-img-overlay">
                    <div class="login-img-badge">
                        <i class="ti ti-map-pin"></i>
                        Fiesta Tours Peru
                    </div>
                    <p class="login-img-title">Descubre el corazón<br>de los Andes</p>
                    <p class="login-img-sub">Experiencias de viaje exclusivas en Perú</p>
                </div>
            </div>

            <div class="login-form-side">
                <div class="login-logo">
                    <div class="login-logo-mark">
                        <i class="ti ti-mountain"></i>
                    </div>
                    <span class="login-logo-name">Solo Personal Autorizado</span>
                </div>

                <h1 class="login-heading">Bienvenido de nuevo</h1>
                <p class="login-subheading">Inicia sesión en tu cuenta para continuar</p>

                @if ($errors->any())
                    <div class="alert-danger">
                        <i class="ti ti-alert-circle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form id="login-form" action="{{ url('/login') }}" method="POST">
                    @csrf
                    
                    <label class="field-label" for="user">Correo electrónico o nombre de usuario</label>
                    <div class="field-wrap">
                        <i class="ti ti-user"></i>
                        <input id="user" name="user" type="text" placeholder="@fiestatoursperu.com" autocomplete="username" value="{{ old('user') }}">
                    </div>
                
                    <label class="field-label" for="password">Contraseña</label>
                    <div class="field-wrap">
                        <i class="ti ti-lock"></i>
                        <input id="password" name="password" type="password" placeholder="••••••••" autocomplete="current-password">
                    </div>
                
                    <a href="#" class="forgot">¿Olvidaste tu contraseña?</a>
                
                    <button type="submit" class="btn-login" id="btn-submit">
                        <span>Iniciar sesión</span> <i class="ti ti-arrow-right"></i>
                    </button>
                </form>
                <p class="login-footer">
                    ¿No tienes una cuenta? <a href="#">Contactar al administrador</a>
                </p>
            </div>

        </div>
    </main>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            const btn = document.getElementById('btn-submit');
            
            btn.innerHTML = `
                <i class="ti ti-loader-2 spinning"></i> 
                <span>Iniciando...</span>
            `;
            
            btn.disabled = true;
            btn.classList.add('btn-loading');
        });
    </script>

</body>
</html>