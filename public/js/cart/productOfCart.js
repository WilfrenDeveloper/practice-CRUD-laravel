

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
    const valueInput = $(this);
    let cantidad = parseInt(valueInput.val().replace(/,/g, ''), 10) || 0;
    cantidad = Math.abs(cantidad);
    const formattedValue = cantidad === 0 ? 1 : numeral(cantidad).format('0,0');
    valueInput.val(formattedValue);
    $(`.card_product_${id}`).find('.products_added').text(cantidad);

    updateSubtotalOfProductOfCart(id)
    editElementOfLocalStorage(id);
})

$('body').on('input', '.productOfCart_descuento', function(){
    const id = $(this).closest('.tr_product').data('id');
    const valueInput = $(this);
    let desc = parseFloat(valueInput.val().replace(/,/g, ''));
    desc = Math.abs(desc);
    const formattedValue = numeral(desc).format('0,0.00');
    valueInput.val(formattedValue);

    updateSubtotalOfProductOfCart(id)
    editElementOfLocalStorage(id);
});

$('body').on('click', '.productOfCart_delete_product', function(){
    let id = $(this).closest('.tr_product').data('id');
    $(this).closest('.tr_product').remove();
    deleteProductOfCart(id)
})

function updateSubtotalOfProductOfCart(id){
    const elementOfCart = $(`.tr_product_${id}`);
    let priceOfProduct = elementOfCart.find('.productOfCart_price').text();
    let quantityOfProducts = elementOfCart.find('.productOfCart_product_quantity').val();
    let descOfProduct = elementOfCart.find('.productOfCart_descuento').val();

    const price = parseFloat(priceOfProduct.replace(/,/g, ''));
    const quantity = parseInt(quantityOfProducts.replace(/,/g, ''));
    const desc = parseFloat(descOfProduct.replace(/,/g, ''));

    const totalPrice= calculateTotalPrice(price, quantity, desc);
    elementOfCart.find('.productOfCart_total').text(numeral(totalPrice).format('0,0.00'));
    const subtotalPrice= calculateSubtotalPrice(price, quantity);
    elementOfCart.find('.productOfCart_subtotal').text(numeral(subtotalPrice).format('0,0.00'));
    totalPriceAllProductsOfCart();
}

function calculateSubtotalPrice(price, quantity){
    return price * quantity;
}

function calculateTotalPrice(price, quantity, desc = 0){
    let porcentaje = 1 - (desc/100);
    return  price * quantity * porcentaje;
    
};


function productCart(product) {
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
                    <input class="productOfCart_descuento form-control" value="${product.descuento}" placeholder="0.00" style="width:40px; text-align:end; height:25px; padding:5px">
                    <span class="input-group-text" style="height:25px; padding:5px">%</span>
                </td>
                <td scope="col" style="text-align:end; padding:8px 3px">
                    <span class="productOfCart_total" data-id='${product.productId}'>${total}</span>
                    <button class="productOfCart_delete_product" style="border-style:none; background:none; color:red; padding:0"><i class='bx bxs-trash'></i></button>
                </td>
            </tr>
        `)
};

