@extends('plantillaBase')


@section('script_head')
<script src="{{asset('js/products/getProducts.js')}}"></script>
<script src="{{asset('js/localStorage/localStorageCart.js')}}"></script>
<script src="{{asset('js/cart/cartProducts.js')}}"></script>
<script src="{{asset('js/cart/productOfCart.js')}}"></script>
<script src="{{asset('js/clientes/getAllClientes.js')}}"></script>
@endsection


@section('welcome')

    <div class="div_welcome" style="display: flex; justify-content:center; align-items:center; flex-direction:column">
        <a class="fs-3 generarFactura_exit" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="position:absolute; top:35px; right:30px">
            <div style="position: relative">
                <p class="totalQuantityOfCart" style="display:none; position:absolute; top:0; right:-5px; font-size:10px; color:white; background-color:red; border-radius:50%; padding:0 2px; text-align:center; min-width:15px; height:15px">0</p>
                <i class='bx bxs-cart'></i>
            </div>
        </a>
    
        
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

    </div>

    <div class="modal_cartProducts">
        @include('cart/cartProducts')
    </div>

   
    
    


    <script src="{{asset('js/view_welcome/welcome.js')}}"></script>
@endsection