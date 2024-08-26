$(document).ready(function () {
    requestAllClientes()
    productsOfCartOfLocalStorage()
});

$('body').on('click', '.generarFactura_back', function (e) {
    e.preventDefault();
    $('.div_welcome').css('display','flex')
    $('.view_generarFactura').css('display','none');
});

$('body').on('click', '.btn_cartProducts-comprar', function () {
    $('.view_generarFactura').css('display','block');
    $('.div_welcome').css('display','none')
});



$('body').on('input', '.generarFactura_product_quantity', function(){
    const id = $(this).data('id');
    const valueInput = $(this);
    let value = parseInt(valueInput.val().replace(/,/g, ''), 10) || 0;
    value = Math.abs(value);
    const formattedValue = value === 0 ? 1 : numeral(value).format('0,0');
    valueInput.val(formattedValue);
})

$('body').on('input', '.generarFactura_descuento', function(){
    const id = $(this).data('id');
    const valueInput = $(this);
    let value = parseFloat(valueInput.val().replace(/,/g, ''));
    value = Math.abs(value);
    const formattedValue = numeral(value).format('0,0.00');
    valueInput.val(formattedValue);
});

$('body').on('click', '.generarFactura_delete_product', function(){
    let id = $(this).closest('.tr_product').data('id');
    deleteProductOfCart(id);
    $(this).closest('.tr_product').remove();
})

function requestAllClientes(){
    $.ajax({
        type: "GET",
        url: "/clientes",
        success: function (response) {
            const clientes = response;
            clientes.forEach(cliente => {
                $('.generarFactura_selectCliente').append(`
                    <option value="${cliente.id}" style="padding: 5px 10px">
                        ${cliente.nombre} ${cliente.apellido}
                    </option>
                `);   
            });
        },
        error: function(err){
            console.error(err);
        }
    });
}

function productsOfCartOfLocalStorage(){
    const getItemCart = localStorage.getItem('cart');
    const arrayCart = JSON.parse(getItemCart);

    arrayCart.forEach(product => {
        let totalPrice = calculateTotalPrice(product.precio, product.quantity);
        totalPrice = numeral(totalPrice).format('0,0');
        let unitPrice = numeral(product.precio).format('0,0');
        $('.generarFactura_productsOfCart').find('tbody').append(`
            <tr class="tr_product tr_product_${product.productId}" data-id="${product.productId}">
                <td scope="col"><img src="/imagen/${product.imagen}" alt=""  style="height:30px"></td>
                <td scope="col">${product.producto} ${product.marca} ${product.modelo}</td>   
                <td scope="col" style="text-align:end">$  ${unitPrice}</td>
                <td scope="col"><input type="" class="generarFactura_product_quantity form-control" value="${product.quantity}" data-id='${product.productId}' min="1" placeholder="0.00" style="width:80px; text-align:end; height:30px"></td>
                <td scope="col" style="display:flex; justify-content:end"><input type="" class="generarFactura_descuento form-control" value="0" placeholder="0.00" style="width:80px; text-align:end; height:30px">%</td>
                <td scope="col" style="text-align:end">
                    <span data-id='${product.productId}'>$  ${totalPrice}</span>
                    <button class="generarFactura_delete_product" style="border-style:none; background:none; color:red"><i class='bx bxs-trash'></i></button>
                </td>
            </tr>
        `)
    });
};

function calculateTotalPrice(price, quantity, desc = 0){
    let porcentaje = 1 - (desc/100);
    if(porcentaje === 0){
        return price * quantity
    } else {
        return  price * quantity * porcentaje;
    }
};