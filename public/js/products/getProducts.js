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
            
            if(message){
                $('.div_message').html(`<i class='bx bx-error-circle' style='font-size: 30px;color:#d90000;'></i> 
                    <p class="p_message" style="font-size: 20px">${message}</p>`);
            } else {
                $('.div_message').html('');
            };
            
            if(offset == 0){
                $('.cards_products').html('');
                addCardsProducts(productos);
            } else {
                addCardsProducts(productos);
            }
            
            function addCardsProducts(productos){ 
                productos.forEach(product => {
                var formattedNumber = numeral(product.precio).format('0,0');
                const array = JSON.stringify(product);
                    $('.cards_products').append(`
                        <div class="card_product_${product.id} card_product" style="width:240px; border: 1px solid #e9e9e9; padding:10px">
                            <figure class="figure" style="width:220px; height:220px; overflow: hidden; display:flex; justify-content: center; align-items:center">
                                <img class="img_product" src="/imagen/${product.imagen}" alt="" style="max-width:180px; max-height:180px">
                            </figure>
                            <hr>
                            <div style="height: 180px; position:relative">
                                <h5>${product.producto} ${product.marca} ${product.modelo}</h5>
                                <p style="opacity: 0.6">Sistema Operativo:</p>
                                <p style="margin-top:-15px;">${product.sistema}</p>
                                <div style="display:flex; justify-content:space-between; position:absolute; bottom:0; width:100%">
                                    <a class="btn_addToCart btn_style" data-id='${product.id}' style="bottom:0px;border-style:none; border-radius:10px; padding:5px 20px 5px 20px; background-color:#00c7c2 "  style="width: 22px">
                                        <i class='bx bx-cart'></i>
                                    </a>
                                    <div class="justify-content-end">
                                        <p class="m-0" style="text-align:end">$${formattedNumber}</p>
                                        <p class="m-0">añadidos: <span class="products_added products_added_${product.id}">0</span></p>
                                    </div>
                                </div>
                                <input class="data_products_${product.id}" value='${array}' type="hidden"> 
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

