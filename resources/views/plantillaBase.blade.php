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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     
        

        <!-- archivos CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <!--- BootsTrap Styles--->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- iconos -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @yield('script_head')
    </head>
<body class="" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">

        <nav class="navbar bg-body-secondary px-5 py-4" >
            <figure class="m-0">
                <a class="navbar-brand" href="/">
                    <img src="https://mascontrolapp.com/pos_naranja/logo/logo44.png" alt="Bootstrap" width="200" height="default">
                </a>
            </figure>

            <div class="div_title m-0">
                
            </div>

            <div class="d-flex justify-content-end fs-5 gap-3">
                <div class="btn-group">
                    <button class="dropdown-toggle border-0 bg-transparent text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-clipboard-check-fill"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="pb-1">
                            <a href="/inventario" class="text-black link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-100-hover ps-2">
                                <i class="bi bi-clipboard2-check"></i> Inventario
                            </a>
                        </li>
                        <li class="pb-1">
                            <a href="/ventas" class="text-black link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-100-hover ps-2">
                                <i class="bi bi-bag-check"></i> Ventas
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button class="dropdown-toggle border-0 bg-transparent text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people-fill"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="pb-1">
                            <a href="/clientes" class="text-black link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-100-hover ps-2">
                                <i class="bi bi-people"></i> Clientes
                            </a>
                        </li>
                    </ul>
                </div>

                <a class="cart_icon fs-3 generarFactura_exit" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="display:none">
                    <div style="position: relative">
                        <p class="totalQuantityOfCart" style="display:none; position:absolute; top:0; right:-5px; font-size:10px; color:white; background-color:red; border-radius:50%; padding:0 2px; text-align:center; min-width:15px; height:15px">0</p>
                        <i class='bx bxs-cart'></i>
                    </div>
                </a>
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
            
            <div class="ventas_page" style="display: flex; justify-content:center; align-items:center">
                @yield('ventas')
            </div>
            
            <div style="display: flex; justify-content:center; align-items:center; flex-direction:column">
                @yield('newProduct')
            </div>
            
            <div style="display: flex; flex-direction:column; justify-content:center; align-items:center">
                @yield('clientes')
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
