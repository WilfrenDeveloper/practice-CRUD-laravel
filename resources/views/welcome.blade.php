@extends('plantillaBase')
@section('welcome')

    <a class="fs-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="position:absolute; top:35px; right:30px">
        <i class='bx bxs-cart'></i>
    </a>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de Compras</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            
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


    <script>
        $(document).ready(function() {
            //Obtener todos los productos al recargar la página
            getProducts();
            addToCart();
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
            let id = $(this).data('id');
            $.ajax({
                type: "get",
                url: `/productos/${id}`,
                success: function (res) {
                    localStorageCart(res);
                },
                error: function(err){
                    console.error('error', err);
                }
            });
        })

        $('body').on('click', '.btn_deleteProductCart', function(){
            let id = $(this).data('id');
            deleteElementOfLocalStorage(id)
        })
    
    </script>
@endsection