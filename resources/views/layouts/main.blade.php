<!DOCTYPE html>
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

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
    /* Sticky footer styles-- */
    html {
      position: relative;
      min-height: 100%;
    }
    body {
      /* Margin bottom by footer height */
      margin-bottom: 60px;
    }
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here */
      height: 60px;
      background-color: #f5f5f5;
    }
    /* Custom page CSS
    -------------------------------------------------- */
    /* Not required for template or sticky footer method. */
    .container2 {
      width: auto;
      max-width: 680px;
      padding: 0 15px;
    }
    .container .text-muted {
      margin: 20px 0;
    }
    </style>
    @yield('css')
</head>
<body>       
    @include('layouts.nav')
    <div class="container">
        @include('layouts.partials.erros')
        @include('layouts.partials.messages')
        @yield('content')
    </div>
    <footer class="footer">
      <div class="container2">
            <p class="text-muted">© Copyright <a>Nelson Araya</a></p>
      </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    @yield('js')
</body>
</html>
