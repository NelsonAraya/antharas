<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="57x57"
         href="{{asset('plugins/icon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" 
        href="{{ asset('plugins/icon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" 
        href="{{ asset('plugins/icon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76"
        href="{{ asset('plugins/icon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" 
        href="{{ asset('plugins/icon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" 
        href="{{ asset('plugins/icon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" 
        href="{{ asset('plugins/icon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" 
        href="{{ asset('plugins/icon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" 
        href="{{ asset('plugins/icon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  
        href="{{ asset('plugins/icon/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" 
        href="{{ asset('plugins/icon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" 
        href="{{ asset('plugins/icon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" 
        href="{{ asset('plugins/icon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('plugins/icon/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" 
        content="{{ asset('plugins/icon/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">
        
        <title>ANTHARAS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                position: relative;
                display: inline-block;
            }

            .title {
                font-size: 65px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar Sesion</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    ANTHARAS 
                </div>
                <footer>© Sistema de administración CBI.</footer>
            </div>
        </div>
        
    </body>
</html>
