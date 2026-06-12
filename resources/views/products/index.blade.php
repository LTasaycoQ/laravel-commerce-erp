<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap');

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Raleway', sans-serif;
            background: #2c3b47;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-wrap {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 540px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 32px rgba(0,0,0,0.10);
            background: #fff;
        }

        .login-img {
            width: 50%;
            background-image: url('https://res.cloudinary.com/dlgeap8h0/image/upload/v1781105098/iStock-2210631585_ef4mer.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .login-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, rgba(34,56,75,0.60) 0%, rgba(34,56,75,0.20) 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem;
        }

        .login-img-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255,255,255,0.15);
            border: 0.5px solid rgba(255,255,255,0.35);
            border-radius: 99px;
            padding: 5px 14px;
            color: #fff;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 12px;
            width: fit-content;
        }

        .login-img-title {
            color: #fff;
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 6px;
            line-height: 1.3;
        }

        .login-img-sub {
            color: rgba(255,255,255,0.70);
            font-size: 13px;
        }

        .login-form-side {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.75rem;
        }

        .login-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2.5rem;
        }

        .login-logo-mark {
            width: 34px;
            height: 34px;
            background: #22384b;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-logo-mark i {
            color: #fff;
            font-size: 17px;
        }

        .login-logo-name {
            font-size: 15px;
            font-weight: 600;
            color: #22384b;
        }

        .login-heading {
            font-size: 26px;
            font-weight: 600;
            color: #22384b;
            margin: 0 0 6px;
        }

        .login-subheading {
            font-size: 13px;
            color: #888;
            margin: 0 0 2rem;
        }

        .field-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #666;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .field-wrap {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .field-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 16px;
            pointer-events: none;
        }

        .field-wrap input {
            width: 100%;
            height: 42px;
            padding: 0 1rem 0 38px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Raleway', sans-serif;
            color: #22384b;
            outline: none;
            transition: border-color 0.2s;
            background: #fafafa;
        }

        .field-wrap input:focus {
            border-color: #22384b;
            background: #fff;
        }

        .field-wrap input::placeholder {
            color: #bbb;
        }

        .forgot {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #888;
            margin-top: -0.75rem;
            margin-bottom: 1.5rem;
            cursor: pointer;
            text-decoration: none;
        }

        .forgot:hover {
            color: #22384b;
        }

        .btn-login {
            width: 100%;
            height: 44px;
            background: #22384b;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Raleway', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.03em;
            transition: opacity 0.15s;
        }

        .btn-login:hover {
            opacity: 0.88;
        }

        .login-footer {
            margin-top: 1.5rem;
            font-size: 12px;
            color: #aaa;
            text-align: center;
        }

        .login-footer a {
            color: #22384b;
            font-weight: 600;
            text-decoration: none;
        }

        @media (max-width: 640px) {
            .login-img {
                display: none;
            }
            .login-form-side {
                width: 100%;
                padding: 2rem 1.5rem;
            }
        }
    </style>
    <title>Login</title>
</head>
<body>

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
           <form action="{{ url('/login') }}" method="POST">
                @csrf
                
                <label class="field-label" for="user">Correo electrónico o nombre de usuario</label>
                <div class="field-wrap">
                    <i class="ti ti-user"></i>
                    <input id="user" name="user" type="text" placeholder="@fiestatoursperu.com" autocomplete="username">
                </div>
            
                <label class="field-label" for="password">Contraseña</label>
                <div class="field-wrap">
                    <i class="ti ti-lock"></i>
                    <input id="password" name="password" type="password" placeholder="••••••••" autocomplete="current-password">
                </div>
            
                <a href="#" class="forgot">¿Olvidaste tu contraseña?</a>
            
                <button type="submit" class="btn-login" id="btn-submit">
                    Iniciar sesión <i class="ti ti-arrow-right"></i>
                </button>
            </form>
            <p class="login-footer">
                ¿No tienes una cuenta? <a href="#">Contactar al administrador</a>
            </p>
        </div>

    </div>

</body>
</html>