@extends('plantillaBase')
@section('welcome')

    <div class="form_search">
        <input class="input input-search" id="search" name="search"  type="search" style="width: 300px">
        <button id="btn-search" style="border-style:none; padding: 12px 30px; color:white; background-color:#00c7c2"> Buscar </button>
    </div>
    
    <!-- aquí aparece un mensaje en caso de que el valor del input no coincida con los productos -->
    <div class="div_message" style="display:flex; align-items:center; gap:10px">      
    </div>

    <div class="cards_products" style="display: flex; gap:10px; flex-wrap: wrap; justify-content:center; position:relative;">
        
    </div>

    <script>
        $(document).ready(function() {

            $.ajax({
                type: "GET",
                url: "/getproducts",
                success: function (res) {
                    $('.cards_products').html(res.html);                  
                },
                error: function(error) {
                    // Manejo de errores
                    console.error('Error:', error);
                }
            });


            $('#btn-search').on('click', function(e){
                e.preventDefault()

                let inputValue = $('.input-search').val();

                $.ajax({
                    type: "GET",
                    url: "/search",
                    data: {value: inputValue},
                    success: function (res) {
                        let productos = res.productos;
                        let message = res.message;

                        //Si el valor del input no coincide con los nom bres de los producto, entonces aparece un mensaje
                        if(message){ //si la variable mensaje tiene algun valor se inserta los elementos
                            $('.div_message').html(`<i class='bx bx-error-circle' style='font-size: 30px;color:#d90000;'></i> 
                                <p class="p_message" style="font-size: 20px">${message}</p>`);
                        } else { //si la variable mensaje no tiene algun valor se eliminan los elementos
                            $('.div_message').html('');
                        };

                        //Resetea todo los elementos dentro la etiqueta .cards_products
                        $('.cards_products').html(res.html);
                                                
                    },
                    error: function(error) {
                        // Manejo de errores
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection