<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!--- archivos javascript -->
        <script src="{{asset('js/isValid.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- archivos CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <!-- iconos -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
<body class="" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">

        <nav style="display:flex; gap:15px; justify-content:space-between; align-items:center; margin:0; padding: 10px 30px; background-color:white;">
            <figure>
            <a href="/">
                <img id="background" src="https://mascontrolapp.com/pos_naranja/logo/logo44.png" style="width:250px"/>
            </a>
            </figure>
            <div style="display: flex; gap:10px; position:relative; font-size:25px">
                <a href="/inventario" style="text-decoration:none; padding:10px">Inventario</a>
                
                <a href="/clientes" style="text-decoration:none; padding:10px">Clientes</a>
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
                @yield('generarFactura')
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
