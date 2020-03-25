<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>@yield('titulo', 'Plantilla')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="vw-100 vh-100 bg-dark"> 

    @include('plantilla.nav')

    <div class="container pt-5 justify-content-center">

    <div class="card">
        <div class="card-body">        
            
            @yield('encabezado')

            <hr>

            @yield('contenido')
        
        </div>
    </div>

    </div>


</body>
</html>
