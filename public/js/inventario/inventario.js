$(document).ready(function () {
    $('.div_title').html('<h1>INVENTARIO</h1>');
    getProductsToInventario();
});

$('body').on('click', '.btn_ver_inventario', function() {
    const value = $(this).closest('.tr_inventario').find('.inventario_input_producto').val();
    const producto = JSON.parse(value);
    stringToObject(producto);     
});

function stringToObject(producto){
    $("#form_editarProducto").attr('action', `/inventario/${producto.id}`);
    $(".producto_id").val(producto.id)
    $(".edit_producto").val(producto.producto);
    $(".edit_marca").val(producto.marca);
    $(".edit_modelo").val(producto.modelo);
    $(".edit_sistema").val(producto.sistema);
    $("#img_actual").attr('src', `/imagen/${producto.imagen}`);
}


let offset = 0
const limit = 5
$('body').on('click', '.btn_verMas_inventario', function (e) {
    e.preventDefault();
    offset += limit
    getProductsToInventario("", offset, limit);
});

function getProductsToInventario(search, offset, limit) {
    $.ajax({
        type: "GET",
        url: "/getproducts",
        data:{
            search,
            offset,
            limit,
        },
        success: function (response) {
            const productos = response.productos;
            for (const producto of productos) {
                let prod = JSON.stringify(producto);
                $('.tbody_productosInventario').append(`
                    <tr class="tr_inventario tr_inventario_${producto.id}">
                        <input class="inventario_input_producto" type="hidden" value='${prod}'>
                        <td style="display:flex; justify-content:center; padding:0 5px; align-items:center">
                            <img src="/imagen/${producto.imagen}" alt="" style="max-width:100px; max-height:60px">
                        </td>
                        <td>${producto.producto}</td>
                        <td>${producto.marca}</td>
                        <td>${producto.modelo}</td>
                        <td>${producto.sistema}</td>
                        <td>${producto.cantidad}</td>
                        <td>${producto.precio}</td>
                        <td style="padding-left: 20px">
                            <div class="modal_eliminar_producto modal-${producto.id}" style="display: none">
                                @csrf
                                    <div id="div_modal_eliminar">
                                        <p>Estás seguro de querer eliminar el producto <br> <strong>${producto.producto} ${producto.marca} ${producto.modelo}</strong></p>
                                        <button onclick="cancelarEliminarProducto(${producto.id})" href="/inventario" id="btn_confirm-cancel" class="a_editar" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:10px 20px; text-align:center; background-color: rgb(104, 104, 104)">Cancelar</button>
                                        <button onclick="aceptarEliminarProducto(${producto.id})" style="text-decoration:none; border: 1px solid; border-radius:5px; color:white; padding:12px 20px; text-align:center; background-color: rgb(31, 209, 0)">Aceptar</button>
                                    </div>
                            </div>
                            <button class="btn_ver_inventario btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modal_verProducto">Ver</button>
                            <button class="btn btn-danger" onclick="modalEliminarProducto(${producto.id})" >Eliminar</button>
                        </td>
                    </tr>
                `);
            }
            
            (response.productos.length === 0) ? $('.btn_verMas_inventario').hide() : $('.btn_verMas_inventario').show();;
        }
    });
}