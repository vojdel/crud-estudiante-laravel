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

    <div id="app">     
            
            @yield('contenido')

    </div>

    </div>

<script>
window.addEventListener('load', function() {
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
});
    
</script>

</body>
</html>
