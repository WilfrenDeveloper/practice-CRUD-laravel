function cartProducts() {
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart) || [];
    $('.container_productsCart').find('tbody').html('');

    arrayCart.forEach(producto => {
        productOfCart(producto);
        productsAdded(producto);
    });
    totalPriceAllProductsOfCart();
}

function productsAdded(producto){
    $(`.card_product_${producto.productId}`).find(".products_added").text(producto.quantity);
    let disponibles = $(`.card_product_${producto.productId}`).find(".cardProduct_disponible").data('disponible');
    $(`.card_product_${producto.productId}`).find(".cardProduct_disponible").text(disponibles - producto.quantity);
    //$(`.products_added_${producto.productId}`).text(producto.quantity);
}

function addProductToCart(producto){
    productsAdded(producto);
    productOfCart(producto);
    totalPriceAllProductsOfCart();
}


function updateProductOfCart(producto){
    $(`.cart_product_${producto.productId}`).find(".product_quantity").val(producto.quantity);
    $(`.tr_product_${producto.productId}`).find('.productOfCart_product_quantity').val(producto.quantity);
    productsAdded(producto);
    totalPriceAllProductsOfCart();
    updateSubtotalOfProductOfCart(producto.productId);
}


function deleteProductOfCart(id){
    $(`.cart_product_${id}`).remove();
    $(`.card_product_${id}`).find(".products_added").html(0);
    totalPriceAllProductsOfCart();
    const elementsOfLC = deleteElementOfLocalStorage(id);
}

function totalPriceAllProductsOfCart(){
    let priceTotal = 0;
    let quantityTotal = 0;
    let totalBruto = 0;
    let totalSubtotal = 0;
    let totalDesc = 0;
    
    const elements =  $('.container_productsOfCart').find('tbody').children();
    
    let itemsTotal = elements.length;

    for(let i=1; i<=elements.length; i++){
        const element = $(`.tr_product:nth-child(${i})`)
        const productPrice = element.find('.productOfCart_total').text();
        const price = parseFloat(productPrice.replace(/,/g, ''));
        const quantity = parseInt(element.find('.productOfCart_product_quantity').val());
        priceTotal += price;
        quantityTotal += quantity;

        let sumaPrecios = element.find('.productOfCart_price').text();
        sumaPrecios = parseFloat(sumaPrecios.replace(/,/g, ''));
        totalBruto += sumaPrecios;
        
        let sumaSubtotales = element.find('.productOfCart_subtotal').text();
        sumaSubtotales = parseFloat(sumaSubtotales.replace(/,/g, ''));
        totalSubtotal += sumaSubtotales;
        
        let sumaDescuentos = element.find('.productOfCart_descuento').val();
        totalDesc += (sumaDescuentos * sumaSubtotales /100);
    }

    if(quantityTotal !== 0){
        $('.totalQuantityOfCart').css('display', 'inline');
        $('.btn_cartProducts-comprar').show();
    } else {
        $('.totalQuantityOfCart').css('display', 'none');
        $('.btn_cartProducts-comprar').hide();
    }

    priceTotal = numeral(priceTotal).format('0,0.00');
    totalBruto = numeral(totalBruto).format('0,0.00');
    totalSubtotal = numeral(totalSubtotal).format('0,0.00');
    totalDesc = numeral(totalDesc).format('0,0.00');

    $('.totalQuantityOfCart').html(quantityTotal)
    $('.totalItemsOfCart').html(itemsTotal)
    $('.totalPriceOfCart').html(priceTotal)
    $('.totalBrutoOfCart').html(totalBruto);
    $('.totalSubtotalOfCart').html(totalSubtotal);
    $('.totalDescOfCart').html(totalDesc);
}




