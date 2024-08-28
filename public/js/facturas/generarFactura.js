$(document).ready(function () {
});

$('body').on('click', '.generarFactura_exit', function () {
    $('.generarFactura').hide();
    allCorrectCliente();
});

$('body').on('click', '.btn_selecionar_cliente', function(e){
    e.preventDefault();
    const id_cliente = $('.generarFactura_select').val();
    getClienteById(id_cliente);
});

$('body').on('submit', '.generarFactura_form', function(e){
    e.preventDefault();
    const getItemCart = localStorage.getItem('cart');
    const cartLocalStorage = JSON.parse(getItemCart);

    const total = $('.totalPriceOfCart').text();
    const precio_total = parseFloat(total.replace(/,/g, ''));

    const cliente = $(this);
    
    if(Array.isArray(cartLocalStorage) && cartLocalStorage.length > 0){
        if(validateClienteOfCart()){
            generarFactura(cliente, cartLocalStorage, precio_total);
        }
    } else {
        alert('Debes añadir productos al carrito antes de generar la factura')
    }
})


function generarFactura(cliente, cart, precio_total){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/generarfactura",
        data: {
            cliente : cliente.serializeArray(),
            cart,
            precio_total,
        },
        success: function (res) {
            alert('factura generada exitosamente');
            console.log(res);
            localStorage.removeItem('cart');
            $('.container_productsOfCart').find('tbody').html('');
            $('.totalQuantityOfCart').html('');
            $('.totalQuantityOfCart').css('display', 'none');
            $('#offcanvasRight').attr('class', 'offcanvas offcanvas-end');
            $('.offcanvas-backdrop').remove();
            $('body').css('overflow', 'auto');
            $(".products_added").text('0');
        },
        error: function (error) {
            console.error(error);
        }
    });
}