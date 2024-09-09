$(document).ready(function () {
    $('.div_title').html('<h1>Clientes</h1>');
    const search = $('.form_search_clientes').serializeArray();
    $('.ventas_tbody').html('');
    getAllClientes(search)
});

let offset = 0;
let limit = parseInt($('.clientes_select_mostrar').val());

$('input').on('input', function (e) { 
    e.preventDefault();
    $(this).removeClass('bg-danger-subtle border-danger');
});

$('body').on('input','.clientes_select_mostrar', function () { 
    limit = parseInt($(this).val());
    offset = 0
    $('.clientes_noFound').hide();
    const search = $('.form_search_clientes').serializeArray();
    $('.tbody_clientes').html('');
    getAllClientes(search, offset, limit);
});

$('body').on('click', '.btn_verMas_clientes', function(e){
    e.preventDefault();
    offset += limit;
    const search = $('.form_search_clientes').serializeArray();
    getAllClientes (search, offset, limit);
});

$('body').on('click', '.btn_search_form_clientes', function(e){
    e.preventDefault();
    offset = 0;
    $('.clientes_noFound').hide();
    const search = $('.form_search_clientes').serializeArray();
    $('.tbody_clientes').html('');
    getAllClientes(search, offset, limit);
});

$('body').on('click', '.btn_ver_cliente', function (e) {
    e.preventDefault();
    $('#form_dataCliente input').removeClass('bg-danger-subtle border-danger');
    $('.btn_aceptar_modal_verCliente').hide();
    $('#form_dataCliente input').attr('disabled', true);
    const value = $(this).closest('.tr_cliente').find('.input_data_cliente').val();
    const cliente = JSON.parse(value);
    
    $('#form_dataCliente').find('#cliente_id').val(`${cliente.id}`);
    $('#form_dataCliente').find('#nombre').val(`${cliente.nombre}`).data('nombre', `${cliente.nombre}`)
    $('#form_dataCliente').find('#apellido').val(`${cliente.apellido}`).data('apellido', `${cliente.apellido}`)
    $('#form_dataCliente').find('#direccion').val(`${cliente.direccion}`).data('direccion', `${cliente.direccion}`)
    $('#form_dataCliente').find('#nacimiento').val(`${cliente.nacimiento}`).data('nacimiento', `${cliente.nacimiento}`)
    $('#form_dataCliente').find('#telefono').val(`${cliente.telefono}`).data('telefono', `${cliente.telefono}`)
    
    $('.clientes_modalFacturaDelCliente_nombre').html(`${cliente?.nombre} ${cliente?.apellido}`)
    $('.clientes_modalFacturaDelCliente_nacimiento').html(`${cliente?.nacimiento ?? ''}`)
    $('.clientes_modalFacturaDelCliente_direccion').html(`${cliente?.direccion ?? ''}`)
    $('.clientes_modalFacturaDelCliente_telefono').html(`${cliente?.telefono ?? ''}`)
    

    

    const facturasDelCliente = cliente.factura;
    $('.facturasDelCliente_modalDatosDelCliente>tbody').html('');
    for (const factura of facturasDelCliente) {
        const dataFactura = JSON.stringify(factura);
        $('.facturasDelCliente_modalDatosDelCliente>tbody').append(`
            <tr>
                <td>
                    <button type="button" class="btn_verFactura_modal_clientes btn btn-link" data-bs-toggle="modal" data-bs-target="#modalFacturaDelCliente">
                    ${factura.codigo}
                    </button>
                    <input type="hidden" value='${dataFactura}'>
                </td>
                <td>${factura.fecha_de_compra}</td>
                <td>${factura.productos.length}</td>
                <td>${numeral(factura.valor_total).format('0,0.00')}</td>
            </tr>    
        `);
    }
});

$('body').on('click', '.btn_ingresar_nuevo_cliente', function (e) {
    e.preventDefault();
    $('#form_crearCliente input').removeClass('bg-danger-subtle border-danger');
    $('#form_crearCliente input').val('');
});

$('body').on('click', '.btn_crear_modalCrearCliente', function(e){
    e.preventDefault();
    const dataNuevocliente = $('.form_crearCliente').serializeArray();
    if(validateFormCliente()){
        crearNuevoCliente(dataNuevocliente)
    }
});

function crearNuevoCliente(datosDelCliente){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "clientes/crear",
        data: {
            data : datosDelCliente,
        },
        success: function (response) {
            const cliente = response.cliente; 
            $('.tbody_clientes').prepend(`
                <tr class="tr_cliente tr_cliente_${cliente.id}" style="height:40px" data-id="${cliente.id}">
                ${addDataClienteToTable(cliente)}
                </tr>
            `)
            $('.btn-close').trigger('click');

            Swal.fire({
                position: "center",
                icon: "success",
                title: "Cliente creado exitosamente",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
}

$('body').on('click', '#btn_editar_datos_modal_verCliente', function (e) {
    e.preventDefault();
    $('.btn_aceptar_modal_verCliente').show();
    $('#form_dataCliente input').attr('disabled', false); 
    $(this).attr('id', 'btn_editarDatos_modal_verCliente')
});

$('body').on('click', '#btn_editarDatos_modal_verCliente', function (e) {
    e.preventDefault();
    $('#form_dataCliente input').removeClass('bg-danger-subtle border-danger');
    $('.btn_aceptar_modal_verCliente').hide();
    $('#form_dataCliente input').attr('disabled', true);
    $(this).attr('id', 'btn_editar_datos_modal_verCliente')

    const nombre = $('#form_dataCliente').find('#nombre');
    const apellido = $('#form_dataCliente').find('#apellido');
    const direccion = $('#form_dataCliente').find('#direccion');
    const nacimiento = $('#form_dataCliente').find('#nacimiento');
    const telefono = $('#form_dataCliente').find('#telefono');

    nombre.val(nombre.data('nombre'));
    apellido.val(apellido.data('apellido'));
    direccion.val(direccion.data('direccion'));
    nacimiento.val(nacimiento.data('nacimiento'));
    telefono.val(telefono.data('telefono'));
});

$('body').on('click', '.btn_aceptar_modal_verCliente', function (e) {
    e.preventDefault();
    const id = $('#form_dataCliente').find('#cliente_id').val();
    const datosDelCliente = $('#form_dataCliente').serializeArray();
    if(validateEditCliente()){
        editarDatosDelCliente(id, datosDelCliente)
    }
});

$('body').on('click', '.btn_eliminar_cliente', function(){
    const nombre = $(this).closest('.tr_cliente').find('.td_nombre').text();
    const apellido = $(this).closest('.tr_cliente').find('.td_apellido').text();
    $('.modal_eliminar_cliente_strong').text(`${nombre} ${apellido}`);
    const id =  $(this).closest('.tr_cliente').data('id');
    $('.input_id_cliente_modal_eliminar_cliente').val(id);

});

$('body').on('click', '.btn_aceptar_modal_eliminar_cliente', function(){
    ('aceptaste eliminar el cliente');
    let id = $(this).siblings('.input_id_cliente_modal_eliminar_cliente').val();
    //eliminarClienteById(id);
}); 

function getAllClientes (search, offset, limit){
    $.ajax({
        type: "GET",
        url: "/clientes/all",
        data:{
            search,
            offset,
            limit,
        },
        success: function (response){
            let clientes = response.clientes;
            (clientes.length < limit) ? $('.btn_verMas_clientes').hide() : $('.btn_verMas_clientes').show();
            for (const cliente of clientes) {
                $('.tbody_clientes').append(`
                    <tr class="tr_cliente tr_cliente_${cliente.id}" style="height:40px" data-id="${cliente.id}">
                    ${addDataClienteToTable(cliente)}
                    </tr>
                `)
            }
        },
        error: function(err){
            console.error(err);
        }
    });
}

function addDataClienteToTable(cliente){
    const dataCliente = JSON.stringify(cliente);
    return `
                <input class="input_data_cliente" type="hidden" value='${dataCliente}'>
                <td class="td_nombre">${cliente.nombre}</td>
                <td class="td_apellido">${cliente.apellido}</td>
                <td class="td_nacimiento">${cliente.nacimiento || ""}</td>
                <td class="td_nacimiento">${cliente.direccion || ""}</td>
                <td class="td_telefono">${cliente.telefono}</td>
                <td style="padding-left: 20px">
                    <button class="btn_ver_cliente btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#modal_verCliente">Ver info</button>
                </td>
        `
}

function editarDatosDelCliente(id, data){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "PUT",
        url: `/cliente/${id}/edit`,
        data:{data},
        success: function (response) {
            const cliente = response.cliente;
            $('.tbody_clientes').find(`.tr_cliente_${cliente.id}`).html(addDataClienteToTable(cliente));
            $('.btn-close').trigger('click');

            Swal.fire({
                position: "center",
                icon: "success",
                title: "Los datos del cliente han sido actualizados",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
}

function eliminarClienteById(id) {
    return '';
}

$('body').on('click', '.btn_verFactura_modal_clientes ', function(e) {
    e.preventDefault()
    const data_factura = $(this).next().val();

    const factura = JSON.parse(data_factura);
    $('.clientes_modalFacturaDelCliente h1').html(`Factura ${factura.codigo}`)
    $('.clientes_modalFacturaDelCliente_fecha').html(`${factura.fecha_de_compra ?? ''}`)
    $('.clientes_modalFacturaDelCliente tbody').html('')
    const productos = factura.productos
    productos.forEach(producto => {
        $('.clientes_modalFacturaDelCliente_tbody').append(modalDataOfFactura(producto))
    });
    calcularTotalesdeLaFactura(factura);
});

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
    const elements = $('.clientes_modalFacturaDelCliente_tbody').children();
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