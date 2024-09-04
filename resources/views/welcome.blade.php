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
        <!-- aquí aparece un mensaje en caso de que el valor del input no coincida con los productos -->
        <div class="div_message" style="display:flex; align-items:center; gap:10px">      
        </div>
        
        <div class="cards_products" style="display: flex; gap:15px; flex-wrap: wrap; justify-content:center; position:relative; padding:20px;">
        </div>
        
        <button class="btn_verMas btn btn-info rounded-0 text-light fs-6" >Ver más...</button>

    </div>

    <div class="modal_cartProducts">
        @include('cart/cartProducts')
    </div>

   
    
    


    <script src="{{asset('js/view_welcome/welcome.js')}}"></script>
@endsection