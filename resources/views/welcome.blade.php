@extends('plantillaBase')
@section('welcome')

    <div class="form_search">
        <input class="input input-search  rounded-0" id="search" name="search"  type="search" style="width: 300px">
        <button id="btn-search" class="btn btn-info rounded-0 text-light fs-6" style="background-color:#00c7c2"> Buscar </button>
    </div>
    
    <!-- aquí aparece un mensaje en caso de que el valor del input no coincida con los productos -->
    <div class="div_message" style="display:flex; align-items:center; gap:10px">      
    </div>
    
    <div class="cards_products" style="display: flex; gap:10px; flex-wrap: wrap; justify-content:center; position:relative;">
    </div>
    
    <button class="btn_verMas btn btn-info rounded-0 text-light fs-6" >Ver más...</button>
    
    <script>
        $(document).ready(function() {
            //Obtener todos los productos al recargar la página
            getProducts()
        });
        
        //Valor del input Search
        let inputValue = "";
        
        //Obtener productos al presionar el botón VER MAS...
        let offset = 0
        $('body').on('click', '.btn_verMas', function (e) {
            e.preventDefault();
            offset += 4
            getProducts(inputValue, offset);
        });

        $('body').on('click', '#btn-search', function(e){
            e.preventDefault()
            inputValue = $('.input-search').val();
            if(inputValue){
                offset = 0
                getProducts(inputValue)
                offset +=4
            }
            console.log(offset);
        });
        
        $('body').on('click',  '.btn_addToCart', function(e){
            e.preventDefault();
            console.log("hola");
        })

    
    </script>
@endsection