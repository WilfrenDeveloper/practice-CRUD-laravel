function getProducts(search, offset = 0, limit){
    $.ajax({
        type: "GET",
        url: "/getproducts",
        data: {
            search,
            offset,
            limit,
        },
        success: function (res) {
            let productos = res.productos
            console.log(res.productos);

            (productos.length < limit) ? $('.btn_verMas').hide() : $('.btn_verMas').show() ;
            
            productos.forEach(product => {
            var formattedNumber = numeral(product.precio).format('0,0');
                const array = JSON.stringify(product);
                    $('.cards_products').append(`
                        <div class="card_product_${product.id} card_product" style="width:240px; border: 1px solid #e9e9e9; padding:10px">
                            <figure class="figure" style="width:220px; height:220px; overflow: hidden; display:flex; justify-content: center; align-items:center">
                                <img class="img_product" src="/imagen/${product.imagen}" alt="" style="max-width:180px; max-height:180px">
                            </figure>
                            <hr>
                            <div style="height: 200px; position:relative">
                                <h5>${product.producto} ${product.marca} ${product.modelo}</h5>
                                <p style="opacity: 0.6; margin:0">Sistema Operativo:</p>
                                <p style="margin:0;">${product.sistema}</p>
                                <p style="margin-top:5px">
                                    <span style="opacity: 0.6">Cantidad disponible: </span>
                                    <span class="cardProduct_disponible">${product.cantidad}</span>
                                    <input class="cardProduct_disponibleOnDB" value="${product.cantidad}" type="hidden">
                                </p>
                                <div style="display:flex; justify-content:space-between; position:absolute; bottom:0; width:100%">
                                    <button class="btn_addToCart btn_style" data-id='${product.id}' style="bottom:0px;border-style:none; border-radius:10px; padding:5px 20px 5px 20px; background-color:#00c7c2 "  style="width: 22px">
                                        <i class='bx bx-cart'></i>
                                    </button>
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

            cartProducts();
            if($('.cards_products').children().length === 0 ){
                $('.div_message').html(`<i class='bx bx-error-circle' style='font-size: 30px;color:#d90000;'></i> 
                    <p class="p_message" style="font-size: 20px">El producto que buscas no se encuentra</p>`);
            } else {
                $('.div_message').html('');
            };
                                  
            
        },
        error: function(error) {
            // Manejo de errores
            console.error('Error:', error);
        }
    });
};

