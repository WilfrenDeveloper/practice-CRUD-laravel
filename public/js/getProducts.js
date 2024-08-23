function getProducts(search = "", offset = 0){
    $.ajax({
        type: "GET",
        url: "/getproducts",
        data: {
            value: search,
            offset
        },
        success: function (res) {
            let productos = res.productos;
            let message = res.message;

            if(productos.length === 0){
                $('.btn_verMas').hide();
            } else {
                $('.btn_verMas').show();
            };
            
            //Si el valor del input no coincide con los nom bres de los producto, entonces aparece un mensaje
            if(message){ //si la variable mensaje tiene algun valor se inserta los elementos
                $('.div_message').html(`<i class='bx bx-error-circle' style='font-size: 30px;color:#d90000;'></i> 
                    <p class="p_message" style="font-size: 20px">${message}</p>`);
            } else { //si la variable mensaje no tiene algun valor se eliminan los elementos
                $('.div_message').html('');
            };
            
            //Resetea todo los elementos dentro la etiqueta .cards_products
            if(offset == 0){
                $('.cards_products').html('');
                addCardsProducts(productos);
            } else {
                addCardsProducts(productos);
            }
            
            function addCardsProducts(productos){
                productos.forEach(product => {
                    $('.cards_products').append(`
                        <div class="card_product" style="">
                            <figure class="figure" style="">
                                <img class="img_product" src="/imagen/${product.imagen}" alt="" style="">
                            </figure>
                            <hr>
                            <div style="height: 180px; position:relative">
                                <h3>${product.producto} ${product.marca} ${product.modelo}</h3>
                                <p style="opacity: 0.6">Sistema Operativo:</p>
                                <p style="margin-top:-15px;">${product.sistema}</p>
                                <!--
                                <a class="a_button" href="/generarfactura/${product.id}" style="position:absolute; bottom:0px;border-style:none; border-radius:10px; padding:5px 20px 5px 20px; background-color:#00c7c2 "  style="width: 22px">
                                    <i class='bx bx-cart'></i>
                                </a>
                                -->
                                <a class="btn_addToCart a_button" style="position:absolute; bottom:0px;border-style:none; border-radius:10px; padding:5px 20px 5px 20px; background-color:#00c7c2 "  style="width: 22px">
                                    <i class='bx bx-cart'></i>
                                    </a>
                            </div>
                        </div>    
                    `);
                });
            }                         
            
        },
        error: function(error) {
            // Manejo de errores
            console.error('Error:', error);
        }
    });
};

