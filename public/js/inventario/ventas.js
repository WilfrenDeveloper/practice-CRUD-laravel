$(document).ready(function () {
    getAllFacturas()
});

$('body').on('click', '.ventas_nombreDelCliente', function(e) {
    e.preventDefault()
    const data_factura = $(this).next().text();
    const factura = JSON.parse(data_factura);
    console.log(factura)
    $('.ventas_modal_cliente h1').html(`Factura ${factura.codigo}`)
    $('.ventas_modalFactura_nombre').html(`${factura.cliente?.nombre} ${factura.cliente?.apellido}`)
    $('.ventas_modalFactura_apellido').html(`${factura.cliente?.nacimiento ?? ''}`)
    $('.ventas_modalFactura_nacimiento').html(`${factura.cliente?.direccion ?? ''}`)
    $('.ventas_modalFactura_telefono').html(`${factura.cliente?.telefono ?? ''}`)
    $('.ventas_modalFactura_fecha').html(`${factura.fecha_de_compra ?? ''}`)
    $('.ventas_modal_cliente tbody').html('')
    const productos = factura.productos
    productos.forEach(producto => {
        $('.ventas_modal_cliente tbody').append(modalDataOfCliente(producto))
    });
    
});

function getAllFacturas (){
    $.ajax({
        type: "GET",
        url: "/facturas/ventas",
        success: function (response) {
            console.log(response);
            response.facturas.forEach(factura => {
                $('.ventas_tbody').append(addAllFacturasInTable(factura));
            });
        },
        error: function (error){
            console.error(error)
        }
    });
};

function modalDataOfCliente(producto){
    return `
       <tr>
        <td>${producto.producto_de_la_factura.producto} ${producto.producto_de_la_factura.marca} ${producto.producto_de_la_factura.modelo}</td>
        <td>${producto.producto_de_la_factura.sistema}</td>
        <td>${numeral(producto.producto_de_la_factura.precio).format('0,0.00')}</td>
        <td>${producto.cantidad}</td>
        <td>${numeral(producto.producto_de_la_factura.precio * producto.cantidad).format('0,0.00')}</td>
        <td>${producto.descuento} %</td>
        <td>${numeral(producto.precio_total).format('0,0.00')}</td>
       </tr>
    `
}

function totales(){};


function addAllFacturasInTable(factura){
    const valorFormatted = numeral(factura.valor_total).format('0,0.00');
    const data_factura = JSON.stringify(factura);
    
    return `
        <tr class="ventas_tr_factura" data-id="${factura.id}">
            <td>
                <a class="ventas_nombreDelCliente link-hover" data-bs-toggle="modal" data-bs-target="#staticBackdrop">${factura.codigo}</a>
                <textarea style="display:none">${data_factura}</textarea>
            </td>
            <td>${factura.cliente.nombre} ${factura.cliente.apellido}</td>
            <td class="text-end">${valorFormatted}</td>
            <td>${factura.factura_metodo_de_pago[0]?.metodo_de_pago.forma_de_pago ?? 'No registra'}</td>
            <td>${factura.fecha_de_compra}</td>
        </tr>
    `
}