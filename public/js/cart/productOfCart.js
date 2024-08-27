

$('body').on('click', '.btn_cartProducts-comprar', function () {
    $('.generarFactura').show();
});

$('body').on('input', '.productOfCart_product_quantity', function(){
    let id = $(this).closest('.tr_product').data('id');
    const valueInput = $(this);
    let cantidad = parseInt(valueInput.val().replace(/,/g, ''), 10) || 0;
    cantidad = Math.abs(cantidad);
    const formattedValue = cantidad === 0 ? 1 : numeral(cantidad).format('0,0');
    valueInput.val(formattedValue);

    updateSubtotalOfProductOfCart(id)
    editElementOfLocalStorage(id);
    console.log(id)
    $(`div.card_product_${id}`).find('.products_added').text(cantidad);
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

    const totalPrice= calculateTotalPrice(price, quantity, desc)
    elementOfCart.find('.productOfCart_total_price').text(numeral(totalPrice).format('0,0.00'))
    totalPriceProducts()
}

function calculateTotalPrice(price, quantity, desc = 0){
    let porcentaje = 1 - (desc/100);
    return  price * quantity * porcentaje;
};


function productCart(product) {
    let totalPrice = calculateTotalPrice(product.precio, product.quantity);
        totalPrice = numeral(totalPrice).format('0,0');
        let unitPrice = numeral(product.precio).format('0,0');
        $('.container_productsOfCart').find('tbody').append(`
            <tr class="tr_product tr_product_${product.productId}" data-id="${product.productId}">
                <td scope="col"><img src="/imagen/${product.imagen}" alt=""  style="height:30px"></td>
                <td scope="col">${product.producto} ${product.marca} ${product.modelo}</td>   
                <td scope="col" class="productOfCart_price" style="text-align:end">${unitPrice}</td>
                <td scope="col"><input type="" class="productOfCart_product_quantity form-control" value="${product.quantity}" data-id='${product.productId}' min="1" placeholder="0.00" style="width:80px; text-align:end; height:30px"></td>
                <td scope="col" style="display:flex; justify-content:end"><input type="" class="productOfCart_descuento form-control" value="${product.descuento}" placeholder="0.00" style="width:80px; text-align:end; height:30px">%</td>
                <td scope="col" style="text-align:end">
                    <span class="productOfCart_total_price" data-id='${product.productId}'>${totalPrice}</span>
                    <button class="productOfCart_delete_product" style="border-style:none; background:none; color:red"><i class='bx bxs-trash'></i></button>
                </td>
            </tr>
        `)
};

