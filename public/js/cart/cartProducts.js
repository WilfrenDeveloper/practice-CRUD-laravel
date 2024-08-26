function cartProducts() {
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart) || [];
    $('.container_productsCart').find('tbody').html('');

    arrayCart.forEach(producto => {
        productCart(producto);
        productsAdded(producto);
    });
    totalPriceProducts();

    requestAllClientes();
}

function productsAdded(producto){
    $(`.card_product_${producto.productId}`).find(".products_added").text(producto.quantity);
}

function addProductToCart(producto){
    productsAdded(producto);
    productCart(producto);
    totalPriceProducts();
}


function updateProductOfCart(producto){
    $(`.cart_product_${producto.productId}`).find(".product_quantity").val(producto.quantity);
    $(`.tr_product_${producto.productId}`).find('.productOfCart_product_quantity').val(producto.quantity);
    productsAdded(producto);
    totalPriceProducts();
    updateSubtotalOfProductOfCart(producto.productId);
}


function deleteProductOfCart(id){
    $(`.cart_product_${id}`).remove();
    $(`.card_product_${id}`).find(".products_added").html(0);
    totalPriceProducts();
    deleteElementOfLocalStorage(id);
}

function totalPriceProducts(){
    let priceTotal = 0;
    let quantityTotal = 0;
    
    const elements =  $('.container_productsOfCart').find('tbody').children();
    
    let itemsTotal = elements.length;

    for(let i=1; i<=elements.length; i++){
        const element = $(`.tr_product:nth-child(${i})`)
        const productPrice = element.find('.productOfCart_total_price').text();
        const price = parseFloat(productPrice.replace(/,/g, ''));
        const quantity = parseInt(element.find('.productOfCart_product_quantity').val());
        priceTotal += price;
        quantityTotal += quantity;
    }

    if(quantityTotal !== 0){
        $('.totalQuantityOfCart').css('display', 'inline')
    } else {
        $('.totalQuantityOfCart').css('display', 'none')
    }

    priceTotal = numeral(priceTotal).format('0,0');

    $('.totalQuantityOfCart').html(quantityTotal)
    $('.totalItemsOfCart').html(itemsTotal)
    $('.totalPriceOfCart').html(priceTotal)
}



