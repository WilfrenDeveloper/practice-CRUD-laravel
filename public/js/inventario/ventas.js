$(document).ready(function () {
    $('.div_title').html('<h1>Ventas</h1>')
    const search = $('.ventas_form_search').serializeArray();
    $('.ventas_tbody').html('');
    getAllFacturas(0, search);
    formaDePago();
});

let offset = 0;
$('body').on('click', '.ventas_btn_verMas', function(){
    offset += 10;
    $('.ventas_noFound').hide();
    const search = $('.ventas_form_search').serializeArray();
    getAllFacturas(offset, search);
})

$('body').on('click', '.btn_ventas_form_search', function(e){
    e.preventDefault();
    offset = 0;
    $('.ventas_noFound').hide();
    const search = $('.ventas_form_search').serializeArray();
    $('.ventas_tbody').html('');
    getAllFacturas(offset, search);

})

$('body').on('click', '.ventas_factura', function(e) {
    e.preventDefault()
    const data_factura = $(this).next().text();
    const factura = JSON.parse(data_factura);
    $('.ventas_modal_cliente h1').html(`Factura ${factura.codigo}`)
    $('.ventas_modalFactura_nombre').html(`${factura.cliente?.nombre} ${factura.cliente?.apellido}`)
    $('.ventas_modalFactura_nacimiento').html(`${factura.cliente?.nacimiento ?? ''}`)
    $('.ventas_modalFactura_direccion').html(`${factura.cliente?.direccion ?? ''}`)
    $('.ventas_modalFactura_telefono').html(`${factura.cliente?.telefono ?? ''}`)
    $('.ventas_modalFactura_fecha').html(`${factura.fecha_de_compra ?? ''}`)
    $('.ventas_modal_cliente tbody').html('')
    const productos = factura.productos
    productos.forEach(producto => {
        $('.ventas_tbody_productsOfFactura').append(modalDataOfFactura(producto))
    });
    calcularTotalesdeLaFactura(factura);
});


function getAllFacturas(offset=0, search = []){
    $.ajax({
        type: "GET",
        url: "/facturas/ventas",
        data: {
            offset,
            search,
        },
        success: function (response) {
            //console.log(response.message)
            //console.log(response.buscar)
            //console.log(response.facturas)
            $('.ventas_btn_verMas').show();
            response.facturas.forEach(factura => {
                $('.ventas_tbody').append(addAllFacturasInTable(factura));
            });

            if(response.facturas.length === 0) {
                $('.ventas_noFound').show();
            }

            if(response.facturas.length === 0) $('.ventas_btn_verMas').hide();
        },
        error: function (error){
            console.error(error)
        }
    });
};

function addAllFacturasInTable(factura){
    const data_factura = JSON.stringify(factura);
    return `
        <tr class="ventas_tr_factura" data-id="${factura.id}">
            <td>
                <a class="ventas_factura link-hover" data-bs-toggle="modal" data-bs-target="#staticBackdrop">${factura.codigo}</a>
                <textarea style="display:none">${data_factura}</textarea>
            </td>
            <td>${factura.cliente.nombre} ${factura.cliente.apellido}</td>
            <td class="text-end">${numeral(factura.valor_total).format('0,0.00')}</td>
            <td>${factura.factura_metodo_de_pago[0]?.metodo_de_pago.forma_de_pago ?? 'No registra'}</td>
            <td>${factura.fecha_de_compra}</td>
            <td>${factura.productos.length}</td>
        </tr>
    `
    
};

function modalDataOfFactura(producto){
    return `
       <tr>
        <td>${producto.producto_de_la_factura.producto} ${producto.producto_de_la_factura.marca} ${producto.producto_de_la_factura.modelo}</td>
        <td>${producto.producto_de_la_factura.sistema}</td>
        <td class="productsOfFactura_precioUnidad text-end">${numeral(producto.producto_de_la_factura.precio).format('0,0.00')}</td>
        <td class="productsOfFactura_cantidad text-center">${producto.cantidad}</td>
        <td class="productsOfFactura_subtotal text-end">${numeral(producto.producto_de_la_factura.precio * producto.cantidad).format('0,0.00')}</td>
        <td class="text-center">${producto.descuento} %</td>
        <td class="productsOfFactura_descuento text-end">${numeral(producto.producto_de_la_factura.precio * producto.cantidad * producto.descuento/100).format('0,0.00')}</td>
        <td class="productsOfFactura_valorTotal text-end">${numeral(producto.precio_total).format('0,0.00')}</td>
       </tr>
    `
}


function calcularTotalesdeLaFactura(){
    const elements = $('.ventas_tbody_productsOfFactura').children();
    let totalBruto = 0;
    let cantidad = 0;
    let subtotal = 0;
    let descuentos = 0;
    let valorTotal = 0;

    elements.each(function() {
        const element = $(this);
        const precioUnidad = parseFloat(element.find('.productsOfFactura_precioUnidad').text().replace(/,/g, ''));
        const cantidadProd = parseInt(element.find('.productsOfFactura_cantidad').text());
        const subtotalProd = parseFloat(element.find('.productsOfFactura_subtotal').text().replace(/,/g, ''));
        const descuentoProd = parseFloat(element.find('.productsOfFactura_descuento').text().replace(/,/g, ''));
        const totalProd = parseFloat(element.find('.productsOfFactura_valorTotal').text().replace(/,/g, ''));
     
        totalBruto += precioUnidad;
        cantidad += cantidadProd;
        subtotal += subtotalProd;
        descuentos += descuentoProd;
        valorTotal += totalProd;
    });

    
    $('.factura_valorBruto').text(numeral(totalBruto).format('0,0.00'));
    $('.factura_cantidad').text(cantidad);
    $('.factura_subtotal').text(numeral(subtotal).format('0,0.00'));
    $('.factura_descuento').text(numeral(descuentos).format('0,0.00'));
    $('.factura_valorTotal').text(numeral(valorTotal).format('0,0.00'));
};

function formaDePago(){  
        $.ajax({
            type: "GET",
            url: "/metodoDePago",
            success: function (response) {
                response['bancos'].forEach(element => {
                    
                    $('.ventas_formSelect_metodos').append(`
                        <option value="${element[0].forma_de_pago}">${element[0].forma_de_pago}</option>
                    `);
                });
                response['cryptos'].forEach(element => {
                    $('.ventas_formSelect_metodos').append(`
                        <option value="${element[0].forma_de_pago}">${element[0].forma_de_pago}</option>
                    `);
                });
                
            }
        }); 
}