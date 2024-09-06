$(document).ready(function () {
    $('.div_title').html('<h1>Clientes</h1>');
    const search = $('.form_search_clientes').serializeArray();
    $('.ventas_tbody').html('');
    getAllClientes(search)
});

let offset = 0;
let limit = parseInt($('.clientes_select_mostrar').val());

$('body').on('change','.clientes_select_mostrar', function () { 
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
    //console.log(limit)
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
    $('.btn_aceptar_modal_verCliente').hide();
    $('#form_dataCliente input').attr('disabled', true);
    const value = $(this).closest('.tr_cliente').find('.input_data_cliente').val();
    const cliente = JSON.parse(value);
    $('#form_dataCliente').find('#cliente_id').val(`${cliente.id}`);
    $('#form_dataCliente').find('#nombre').val(`${cliente.nombre}`);
    $('#form_dataCliente').find('#apellido').val(`${cliente.apellido}`);
    $('#form_dataCliente').find('#direccion').val(`${cliente.direccion}`);
    $('#form_dataCliente').find('#nacimiento').val(`${cliente.nacimiento}`);
    $('#form_dataCliente').find('#telefono').val(`${cliente.telefono}`);

    

    const facturasDelCliente = cliente.factura;
    $('.facturasDelCliente_modalDatosDelCliente>tbody').html('');
    
    for (const factura of facturasDelCliente) {
        $('.facturasDelCliente_modalDatosDelCliente>tbody').append(`
            <tr>
                <td class="btn btn-link">${factura.codigo}</td>
                <td>${factura.fecha_de_compra}</td>
                <td>${factura.productos.length}</td>
                <td>${numeral(factura.valor_total).format('0,0.00')}</td>
            </tr>    
        `);
    }
});

$('body').on('click', '.btn_ingresar_nuevo_cliente', function (e) {
    e.preventDefault();
    $('#form_dataCliente input').val('');
});

$('body').on('click', '.btn_crear_cliente', function(){
    const dataNuevocliente = $('.form_dataCliente');
});

$('body').on('click', '.btn_crear_cliente', function(){
    const dataNuevocliente = $('.form_dataCliente');
});

$('body').on('click', '.btn_editar_datos_modal_verCliente', function (e) {
    e.preventDefault();
    $('.btn_aceptar_modal_verCliente').show();
    $('#form_dataCliente input').attr('disabled', false);
});

$('body').on('click', '.btn_aceptar_modal_verCliente', function (e) {
    e.preventDefault();
    const id = $('#form_dataCliente').find('#cliente_id').val();
    const datosDelCliente = $('#form_dataCliente').serializeArray();
    editarDatosDelCliente(id, datosDelCliente)
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
                $('.tbody_clientes').append(
                `
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
        }
    });
}

function eliminarClienteById(id) {
    return '';
}