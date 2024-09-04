function cartProducts() {
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart) || [];
    $('.container_productsCart').find('tbody').html('');

    for(const producto of arrayCart){
        productOfCart(producto);
        productsAdded(producto);
    }
    totalPriceAllProductsOfCart();
}


$('body').on('click', '.btn_cartProducts-comprar', function (e) {
    e.preventDefault();
    const getItemCart = localStorage.getItem('cart');
    const cartLocalStorage = JSON.parse(getItemCart);
    
    $('.generarFactura').show();
    $('.generarFactura_select').html(`
        <option value="1">Efectivo</option>
    `)
    metodo_de_pago();
});

$('body').on('input', '.productOfCart_product_quantity', function(){
    let id = $(this).closest('.tr_product').data('id');
    const max = Number($(`.card_product_${id}`).find('.cardProduct_disponibleOnDB').val());
    const valueInput = $(this);
    let cantidad = parseInt(valueInput.val().replace(/,/g, ''), 10) || 0;
    cantidad = Math.abs(cantidad);
    if(Number(cantidad) > max) cantidad = max;
    const formattedValue = cantidad === 0 ? 1 : numeral(cantidad).format('0,0');
    valueInput.val(formattedValue);
    $(`.card_product_${id}`).find('.products_added').text(cantidad);
    let disponibles = $(`.card_product_${id}`).find(".cardProduct_disponibleOnDB").val();
    $(`.card_product_${id}`).find(".cardProduct_disponible").text(disponibles - cantidad);

    updateSubtotalOfProductOfCart(id);
    editElementOfLocalStorage(id);
})

$('body').on('change', '.productOfCart_descuento', function(){
    const id = $(this).closest('.tr_product').data('id');
    const valueInput = $(this);
    let desc = parseFloat(valueInput.val().replace(/,/g, ''));
    desc = Math.abs(desc);
    if(parseFloat(desc) > 100){desc = 100};
    valueInput.val((Number.isInteger(desc))?desc:numeral(desc).format('0,0.00'));

    updateSubtotalOfProductOfCart(id)
    editElementOfLocalStorage(id);
});

$('body').on('click', '.productOfCart_delete_product', function(){
    let id = $(this).closest('.tr_product').data('id');
    $(this).closest('.tr_product').remove();

    let disponibles = $(`.card_product_${id}`).find(".cardProduct_disponibleOnDB").val();
    $(`.card_product_${id}`).find(".cardProduct_disponible").html(disponibles);
    deleteProductOfCart(id);
});

function productsAdded(producto){
    $(`.card_product_${producto.productId}`).find(".products_added").text(producto.quantity);
    let disponibles = $(`.card_product_${producto.productId}`).find(".cardProduct_disponibleOnDB").val();
    $(`.card_product_${producto.productId}`).find(".cardProduct_disponible").text(disponibles - producto.quantity);
}

function updateSubtotalOfProductOfCart(id){
    const elementOfCart = $(`.tr_product_${id}`);
    let priceOfProduct = elementOfCart.find('.productOfCart_price').text();
    let quantityOfProducts = elementOfCart.find('.productOfCart_product_quantity').val();
    let descOfProduct = elementOfCart.find('.productOfCart_descuento').val();

    const price = parseFloat(priceOfProduct.replace(/,/g, ''));
    const quantity = parseInt(quantityOfProducts.replace(/,/g, ''));
    const desc = parseFloat(descOfProduct.replace(/,/g, ''));

    const subtotalPrice= calculateSubtotalPrice(price, quantity);
    elementOfCart.find('.productOfCart_subtotal').text(numeral(subtotalPrice).format('0,0.00'));
    const totalPrice= calculateTotalPrice(price, quantity, desc);
    elementOfCart.find('.productOfCart_total').text(numeral(totalPrice).format('0,0.00'));
    totalPriceAllProductsOfCart();
}

function calculateSubtotalPrice(price, quantity){
    return price * quantity;
}

function calculateTotalPrice(price, quantity, desc = 0){
    let porcentaje = 1 - (desc/100);
    return  price * quantity * porcentaje;
    
};

function addProductToCart(producto){
    productOfCart(producto);
    totalPriceAllProductsOfCart();
    productsAdded(producto);
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
    deleteElementOfLocalStorage(id);
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

    $('.totalQuantityOfCart').html(quantityTotal)
    $('.totalItemsOfCart').html(itemsTotal)
    $('.totalPriceOfCart').html(numeral(priceTotal).format('0,0.00'))
    $('.totalBrutoOfCart').html(numeral(totalBruto).format('0,0.00'));
    $('.totalSubtotalOfCart').html(numeral(totalSubtotal).format('0,0.00'));
    $('.totalDescOfCart').html(numeral(totalDesc).format('0,0.00'));
}


function productOfCart(product) {
    let subtotal = calculateSubtotalPrice(product.precio, product.quantity);
        subtotal = numeral(subtotal).format('0,0.00');
    let total = calculateTotalPrice(product.precio, product.quantity, product.descuento);
        total = numeral(total).format('0,0.00');
    let unitPrice = numeral(product.precio).format('0,0');
        $('.container_productsOfCart').find('tbody').append(`
            <tr class="tr_product tr_product_${product.productId}" data-id="${product.productId}">
                <td scope="col"><img src="/imagen/${product.imagen}" alt=""  style="height:30px"></td>
                <td scope="col">${product.producto} ${product.marca} ${product.modelo}</td>   
                <td scope="col" class="productOfCart_price" style="text-align:end">${unitPrice}</td>
                <td scope="col"><input type="" class="productOfCart_product_quantity form-control" value="${product.quantity}" data-id='${product.productId}' min="1" placeholder="0.00" style="width:60px; text-align:end; height:25px; padding:5px"></td>
                <td scope="col" style="text-align:end; padding:8px 3px">
                    <span class="productOfCart_subtotal" data-id='${product.productId}'>${subtotal}</span>
                </td>
                <td scope="col" class="input-group mb-3" >
                    <input class="productOfCart_descuento form-control" value="${product.descuento}" min="0" style="width:40px; text-align:end; height:25px; padding:5px">
                    <span class="input-group-text" style="height:25px; padding:5px">%</span>
                </td>
                <td scope="col" style="text-align:end; padding:8px 3px">
                    <span class="productOfCart_total" data-id='${product.productId}'>${total}</span>
                    <button class="productOfCart_delete_product" style="border-style:none; background:none; color:red; padding:0"><i class='bx bxs-trash'></i></button>
                </td>
            </tr>
        `)
};



