<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sin Valor' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap');
        *, *::before, *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        }

        body {
            min-height: 100vh;            
            font-family: 'Raleway', sans-serif;
            background-color: #EDECE8;
        }

        .container-user__signout--content{
            display: flex;
            align-items:center;
            justify-content:space-between;
            padding: 0.15rem 2rem;
            width: 100%;
        }

        .container-user__signout--content_feature{
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .container-user__signout--content-avatar{
            width: 50px;
            height: 50px;
            margin-right: 0.75rem;
        }

        .container-user_names{
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .container-header__subnav{
            width: 100%;
            height: 50px;
            background-color: #eeeded;
        }

        .container-user__signout--content-avatar-img{
            width: 100%;
            height: 100%;
            border-radius: 30%;
            object-fit: cover;
        }

        .container-user__signout--content-info{
            display: flex;
            flex-direction: column;
        }

        .dashboard-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 320px;
            min-width: 220px;
            background-color: #000000;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 0;
        }

        .sidebar-logo {
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            padding: 0 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 0.75rem;
            display: block;
        }

        .container-nav{
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .sidebar-links {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
            background-color: #515a6b;
            padding: 0 0.75rem;
        }

        .sidebar-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: background 0.15s, color 0.15s;
        }

        .sidebar-links a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .container-user__signout{
            width: 100%;
            display: flex;
        }

        .span-layout_text_username{
            color: #fff;
            text-transform: uppercase;
            font-size: 1.2rem;
            font-weight: 800;

        }

        .span-layout_text_userlastname{
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.875rem;
            font-weight: 900;
        }

        .container-user__signout--content-link{
            color: white;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            font-size: 1.5em;
        }

        .main-content {
            flex: 1;
            overflow-y: auto;
        }

        .logo_layout{
            display:flex;
            width: 150px;

        }

</style>

</head>
<body>
    <div class="dashboard-layout">

        <aside class="sidebar">
            <div class="">
                <a href="/" class="sidebar-logo">
                    <img src="{{ asset('images/Logo-FTI-port-black.png') }}" class="logo_layout" alt="">
                </a>
            </div>
            <div class='container-nav'>
                <nav class="sidebar-links">
                    <a href="/dashboard">Dashboard</a>
                    <a href="/login">Cliente</a>
                    <a href=""><i class="bi bi-boxes"></i>Proveedores</a>
                </nav>

                <div class="container-user__signout">

                    <div class="container-user__signout--content">
                        
                        <div class="container-user__signout--content_feature">
                            <div class="container-user__signout--content-avatar">
                                <img class="container-user__signout--content-avatar-img" src="https://res.cloudinary.com/dlgeap8h0/image/upload/f_auto,q_auto/v1778193409/main-sample.png" alt="">
                            </div>
                            <div class="container-user__signout--content-info">
                                <div class="container-user_names">    
                                    <p class="span-layout_text_username">Luis Angel w</p>
                                    <span class="span-layout_text_userlastname">Tasayco Quispe</span>
                                </div>
                            </div>
                        </div>
                        <a href="/" class="container-user__signout--content-link"><i class="bi bi-box-arrow-right"></i></a>

                    </div>


                </div>
            </div>
        </aside>

        <main class="main-content">

            <div class="container-header__subnav">
                
            </div>

            
            {{ $slot }}
        </main>

    </div>
</body>
</html>