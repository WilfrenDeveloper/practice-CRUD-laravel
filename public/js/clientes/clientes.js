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
    const value = $(this).closest('.tr_cliente').find('.input_data_cliente').val();
    const cliente = JSON.parse(value);
    $('#form_dataCliente').find('#nombre').val(`${cliente.nombre}`);
    $('#form_dataCliente').find('#apellido').val(`${cliente.apellido}`);
    $('#form_dataCliente').find('#direccion').val(`${cliente.direccion}`);
    $('#form_dataCliente').find('#nacimiento').val(`${cliente.nacimiento}`);
    $('#form_dataCliente').find('#telefono').val(`${cliente.telefono}`);

    console.log(cliente)
});

$('body').on('click', '.btn_crear_cliente', function (e) {
    e.preventDefault();
    $('#form_dataCliente input').val('');
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
            //console.log(response);
            let clientes = response.clientes;
            (clientes.length < limit) ? $('.btn_verMas_clientes').hide() : $('.btn_verMas_clientes').show();
            for (const cliente of clientes) {
                const dataCliente = JSON.stringify(cliente);
                $('.tbody_clientes').append(`
                    <tr class="tr_cliente tr_cliente_${cliente.id}" style="height:40px" data-id="${cliente.id}">
                        <input class="input_data_cliente" type="hidden" value='${dataCliente}'>
                        <td class="td_nombre">${cliente.nombre}</td>
                        <td class="td_apellido">${cliente.apellido}</td>
                        <td class="td_nacimiento">${cliente.nacimiento || ""}</td>
                        <td class="td_nacimiento">${cliente.direccion || ""}</td>
                        <td class="td_telefono">${cliente.telefono}</td>
                        <td style="padding-left: 20px; ">
                            <a href="/clientes/${cliente.id}" style="text-decoration:none;  padding:12px 20px; text-align:center">Ver historial de compras</a>
                        </td>
                        <td style="padding-left: 20px">
                            <!-- modal confirmar eliminacion -->
                            <div class="modal_eliminar_cliente modal_${cliente.id}" style="display: none">
                                <div id="div_modal_eliminar">
                                    @csrf
                                    <p>Estás seguro de querer eliminar el Cliente <br> <strong>${cliente.nombre} ${cliente.apellido}</strong></p>
                                    <button onclick="cancelarEliminarCliente(${cliente.id})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Cancelar</button>
                                    <button onclick="confirmarEliminarCliente(${cliente.id})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(9, 218, 43)">Aceptar</button>
                                </div>
                            </div>
                            <button class="btn_ver_cliente btn btn-info text-white" type="button" data-bs-toggle="modal" data-bs-target="#modal_verCliente">Ver</button>
                            <button class=" btn btn-danger" type="button" onclick="activarmodalEliminar(${cliente.id})" >Eliminar</button>
                        </td>
                    </tr>
                `);
            }
        },
        error: function(err){
            console.error(err);
        }
    });

}