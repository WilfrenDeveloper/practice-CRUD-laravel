@extends('plantillaBase')


@section('script_head')
<script src="{{asset('js/products/getProducts.js')}}"></script>
<script src="{{asset('js/localStorage/localStorageCart.js')}}"></script>
<script src="{{asset('js/cart/cartProducts.js')}}"></script>
@endsection


@section('welcome')

    <a class="fs-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="position:absolute; top:35px; right:30px">
        <i class='bx bxs-cart'></i>
    </a>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de Compras</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body container_productsCart"> </div>

        <div class="ms-3"> 
            <h5>Precio total: <strong class="totalPriceOfCart">0</strong></h5>
        </div>
    </div>

    <div class="form_search">
        <input class="input input-search  rounded-0" id="search" name="search"  type="search" style="width: 300px">
        <button type="button" id="btn-search" class="btn btn-info rounded-0 text-light fs-6" > Buscar </button>
    </div>
    
    <!-- aquí aparece un mensaje en caso de que el valor del input no coincida con los productos -->
    <div class="div_message" style="display:flex; align-items:center; gap:10px">      
    </div>
    
    <div class="cards_products" style="display: flex; gap:15px; flex-wrap: wrap; justify-content:center; position:relative; padding:20px">
    </div>
    
    <button class="btn_verMas btn btn-info rounded-0 text-light fs-6" >Ver más...</button>

    <script src="{{asset('js/view_welcome/welcome.js')}}"></script>
@endsection