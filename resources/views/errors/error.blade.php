<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <style>
            .error-container {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                background-color: #f8fafc;
            }
            
            .error-content {
                padding: 2rem;
                background-color: white;
                border-radius: 0.5rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                text-align: center;
                max-width: 32rem;
            }
            
            .error-code {
                font-size: 3rem;
                font-weight: bold;
                color: #ef4444;
                margin-bottom: 1rem;
            }
            
            .error-message {
                font-size: 1.5rem;
                color: #4b5563;
                margin-bottom: 1.5rem;
            }
            
            .home-button {
                display: inline-block;
                padding: 0.5rem 1rem;
                background-color: #3b82f6;
                color: white;
                border-radius: 0.25rem;
                text-decoration: none;
                transition: background-color 0.2s;
            }
            
            .home-button:hover {
                background-color: #2563eb;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <div class="error-content">
                <div class="error-code">@yield('code')</div>
                <div class="error-message">@yield('message')</div>
                <a href="{{ url('/') }}" class="home-button">Volver al inicio</a>
            </div>
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>