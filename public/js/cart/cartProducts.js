function cartProducts() {
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart) || [];
    $('.container_productsCart').html('');

    arrayCart.forEach(producto => {
        $('.container_productsCart').append(productOfCart(producto));
        productsAdded(producto)
    });
    totalPriceProducts();
}

function productsAdded(producto){
    $(`.card_product_${producto.productId}`).find(".products_added").html(producto.quantity);
}

function addProductToCart(producto){
    $('.container_productsCart').append(productOfCart(producto));
    totalPriceProducts();
    productsAdded(producto);
}

function updateProductOfCart(producto){
    $(`.cart_product_${producto.productId}`).find(".product_quantity").val(producto.quantity);
    totalPriceProducts();
    productsAdded(producto);
}

function deleteProductOfCart(id){
    $(`.cart_product_${id}`).remove();
    $(`.card_product_${id}`).find(".products_added").html(0);
    totalPriceProducts();
}

function totalPriceProducts(){
    let priceTotal = 0;
    let quantityTotal = 0;
    
    const elements = $('.container_productsCart').children();
    let itemsTotal = elements.length;

    for(let i=1; i<=elements.length; i++){
        const element = $(`.cart_product:nth-child(${i})`)
        const productPrice = parseFloat(element.find('.product_price').text());
        const productQuantity = parseInt(element.find('.product_quantity').val());
        priceTotal += productPrice * productQuantity;
        quantityTotal += productQuantity;
    }

    if(quantityTotal !== 0){
        $('.totalQuantityOfCart').css('display', 'inline')
    } else {
        $('.totalQuantityOfCart').css('display', 'none')
    }

    $('.totalQuantityOfCart').html(quantityTotal)
    $('.totalItemsOfCart').html(itemsTotal)
    $('.totalPriceOfCart').html(priceTotal)
}

function btnPlusProducts(id){
    const productInString = $(`.card_product_${id}`).find(`.data_products_${id}`).val();
    const stringToObject = JSON.parse(productInString);
    localStorageCart(stringToObject);
}   

function btnMinusProducts(id){
    const productInString = $(`.card_product_${id}`).find(`.data_products_${id}`).val();
    const stringToObject = JSON.parse(productInString);
    localStorageCart(stringToObject, 'minus');
}

function productOfCart(producto){
    return  `
            <div class="card mb-3 cart_product cart_product_${producto.productId}" data-id="${producto.productId}" style="max-width: 350px">
                <div class="row g-0">
                    <div class="col-md-4 d-flex justify-content-center align-items-center" height="100%">
                        <img src="imagen/${producto.imagen}" class="img-fluid rounded-start" alt="..." style="height:80px">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h6 class="card-title">${producto.producto} ${producto.marca} ${producto.modelo}</h6>
                        <div class="d-flex justify-content-between">
                            <p class="card-text">
                                <small class="text-body-secondary">Cantidad: </small>
                                <div>
                                    <input class="product_quantity form-control" value="${producto.quantity}" onchange="valueChange(${producto.productId})" min="0" type="number" style="width:50px; height:24px"> 
                                    <button class="btn_plus_cart" style="border-style:none; background:none; margin:0; padding:0"><i class='bx bxs-plus-circle'></i></button>
                                    <button class="btn_minus_cart" style="border-style:none; background:none; margin:0; padding:0"><i class='bx bxs-minus-circle'></i></button>
                                </div>
                            </p>
                            <button class="btn btn-primary btn_deleteProductCart" >
                                <i class='bx bxs-trash'></i>
                            </button>
                        </div>
                        <p class="card-text">Precio: <small class="text-body-secondary product_price">${producto.precio}</small></p>
                    </div>
                    </div>
                </div>
            </div>
        `
}

