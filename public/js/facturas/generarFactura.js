$(document).ready(function () {
    requestAllClientes();
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

    const cliente = $(this);
    
    if(Array.isArray(cartLocalStorage) && cartLocalStorage.length > 0){
        if(validateClienteOfCart()){
            generarFactura(cliente, cartLocalStorage);
        }
    } else {
        alert('Debes añadir productos al carrito antes de generar la factura')
    }
})

function requestAllClientes(){
    $.ajax({
        type: "GET",
        url: "/clientes",
        success: function (response) {
            const clientes = response;
            clientes.forEach(cliente => {
                $('.generarFactura_select').append(`
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

function getClienteById(id){

    $.ajax({
        type: "GET",
        url: `/clientes/${id}`,
        success: function (res) {
            console.log(res)
        }
    });
}

function generarFactura(cliente, cart){
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
            cart : cart
        },
        success: function (response) {
            console.log(response);
            console.log('la respues ha sido exitosa')
        },
        error: function (error) { 
            console.log('la respuesta ha sido erronea')
            console.error(error);
        }
    });
}