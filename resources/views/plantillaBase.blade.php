<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!--- archivos javascript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
        <script src="{{asset('js/isValid.js')}}"></script>
     
        

        <!-- archivos CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <!--- BootsTrap Styles--->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- iconos -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @yield('script_head')
    </head>
<body class="" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">

        <nav class="navbar bg-body-tertiary p-4 bg-white mb-2">
            <figure class="">
              <a class="navbar-brand" href="/">
                <img src="https://mascontrolapp.com/pos_naranja/logo/logo44.png" alt="Bootstrap" width="250" height="default">
              </a>
            </figure>
            <div class="d-flex justify-content-end fs-4 gap-4 me-5">
                <a href="/inventario" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-100-hover">Inventario</a>
                
                <a href="/clientes" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-100-hover me-4">Clientes</a>
            </div>
        </nav>


        <main style="margin-top:0px">

            <div style="display: flex; justify-content:center; align-items:center; flex-direction:column">
                @yield('welcome')
            </div>

            <div style="display: flex; justify-content:center; align-items:center">
                @yield('inventario')
            </div>

            <div style="display: flex; justify-content:center; align-items:center">
                @yield('comprasDelCliente')
            </div>
            
            <div style="display: flex; justify-content:center; align-items:center">
                @yield('ventas')
            </div>
            
            <div style="display: flex; justify-content:center; align-items:center; flex-direction:column">
                @yield('newProduct')
            </div>
            
            <div style="display: flex; justify-content:center; align-items:center">
                @yield('clientes')
            </div>

            <div style="display: flex; justify-content:center; align-items:center; flex-direction:column">
                
            </div>

            <div style="display: flex; justify-content:center; align-items:center; flex-direction:column">
                @yield('crearCliente')
            </div>

            <div style="display: flex; justify-content:center; align-items:center; flex-direction:column">
                @yield('editarCliente')
            </div>

        </main>

    </body>

</html>
