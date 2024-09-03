$(document).ready(function () {
});

$('body').on('click', '.generarFactura_exit', function () {
    allCorrectCliente();
    $('.generarFactura_select').html(`
        <option value="1">Efectivo</option>
    `)
});


$('body').on('click', '.btn_comprar_generarFactura', function(e){
    e.preventDefault();
    const getItemCart = localStorage.getItem('cart');
    const cartLocalStorage = JSON.parse(getItemCart);

    const total = $('.totalPriceOfCart').text();
    const precio_total = parseFloat(total.replace(/,/g, ''));

    const cliente = $('.generarFactura_form'); 

    const metodo_de_pago = $('.generarFactura_select').val();
    if(validateClienteOfCart()){
        generarFactura(cliente, cartLocalStorage, precio_total, metodo_de_pago);
        $('.generarFactura_select').html(`
            <option value="1">Efectivo</option>
        `)
    }
});

$('body').on('click', '.generarFactura_btn_comprar', function(){
    
})

function metodo_de_pago(){   
    $.ajax({
        type: "GET",
        url: "/metodoDePago",
        success: function (response) {
            response['bancos'].forEach(element => {
                $('.generarFactura_select').append(`
                    <option value="${element[0].id}">${element[0].forma_de_pago} ${element[1].tipo_de_cuenta} - ${element[1].numero_de_cuenta}</option>
                `);
            });
            response['cryptos'].forEach(element => {
                $('.generarFactura_select').append(`
                    <option value="${element[0].id}">${element[0].forma_de_pago} - ${element[1].wallet}</option>
                `);
            });
        }
    });
}

function generarFactura(cliente, cart, precio_total, metodo){
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
            metodo,
        },
        success: function(res) {
            console.log(res)
            localStorage.removeItem('cart');
            $('.container_productsOfCart').find('tbody').html('');
            $('.totalQuantityOfCart').html('');
            $('.totalQuantityOfCart').css('display', 'none');
            //$('#offcanvasRight').attr('class', 'offcanvas offcanvas-end');
            //$('.offcanvas-backdrop').remove();
            //$('body').css('overflow', 'auto');
            $(".products_added").text('0');

            res.cart.forEach(id => {
                let disponible = $(`.card_product_${id}`).find('.cardProduct_disponible').text();
                console.log(disponible)
                $(`.card_product_${id}`).find('.cardProduct_disponible').attr('data-disponible', `${disponible}`)
            });
            
            Swal.fire({
                title: "Felicidades por tu Compra",
                text: "La compra fué realizada exitosamente",
                icon: "success"
              });
        },
        error: function (error) {
            console.error(error);
        }
    });
}