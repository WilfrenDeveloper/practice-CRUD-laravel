$(document).ready(function () {
    $('.div_title').html('<h1>INVENTARIO</h1>');
    getProductsToInventario();
});

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
                        ${productoEnLaTabla(producto)}
                    </tr>
                `);
            }
            
            (response.productos.length === 0) ? $('.btn_verMas_inventario').hide() : $('.btn_verMas_inventario').show();;
        }
    });
};

function productoEnLaTabla(producto) {
    return `
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
            <button class="btn_verProducto_del_inventario btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modal_datosDelProducto">Ver</button>
            <button class="btn_eliminarProducto_inventario btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmarEliminarProductoModal">Eliminar</button>
        </td>
    `
}

$('input').on('input', function (e) { 
    e.preventDefault();
    $(this).removeClass('bg-danger-subtle border-danger');
    $('#form_datosDelProducto label').removeClass('bg-danger-subtle border-danger');
});

$('body').on('click', '#btn_ingresarNuevoProducto', function(e) {
    e.preventDefault()
    $('.form_datosDelproducto input').val('');
    $('.form_datosDelproducto img').removeAttr('src');

    $('#form_datosDelProducto label').removeClass('bg-danger-subtle border-danger');
    $('#form_datosDelProducto input').removeClass('bg-danger-subtle border-danger');
    $('#btn_crearEditar_datosDelProducto').removeClass('btn_editar_datosDelProducto');
    $('#btn_crearEditar_datosDelProducto').text('Crear').addClass('btn_crear_datosDelProducto');
});

$('body').on('click', '.btn_verProducto_del_inventario', function() {
    const value = $(this).closest('.tr_inventario').find('.inventario_input_producto').val();
    const producto = JSON.parse(value);
    
    $("#modal_datosDelProducto #producto_id").val(producto.id)
    $("#modal_datosDelProducto #producto").val(producto.producto);
    $("#modal_datosDelProducto #marca").val(producto.marca);
    $("#modal_datosDelProducto #modelo").val(producto.modelo);
    $("#modal_datosDelProducto #sistema").val(producto.sistema);
    $("#modal_datosDelProducto #precio").val(producto.precio);
    $("#modal_datosDelProducto #cantidad").val(producto.cantidad);
    $('#modal_datosDelProducto #mostrarImagen').attr('src',  `/imagen/${producto.imagen}`);

    $('#form_datosDelProducto label').removeClass('bg-danger-subtle border-danger');
    $('#form_datosDelProducto input').removeClass('bg-danger-subtle border-danger');
    $('#btn_crearEditar_datosDelProducto').removeClass('btn_crear_datosDelProducto');
    $('#btn_crearEditar_datosDelProducto').text('Editar').addClass('btn_editar_datosDelProducto');
});

$('body').on('input', '#form_datosDelProducto #imagen', function(e){
    e.preventDefault();
    if($('#form_datosDelProducto #imagen').val()){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#form_datosDelProducto #mostrarImagen').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    } else {
        $('#form_datosDelProducto #mostrarImagen').removeAttr('src');
    }
});

$('body').on('click', '.btn_crear_datosDelProducto', function() {
    console.log('Crear')
    if(validateFormProduct()){
        var formData = new FormData($('.form_datosDelproducto')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/productos/create", 
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                const producto = response.producto;
                let prod = JSON.stringify(producto);
                $(`.tbody_productosInventario`).prepend(`
                    <tr class="tr_inventario tr_inventario_${producto.id}">
                        <input class="inventario_input_producto" type="hidden" value='${prod}'>
                        ${productoEnLaTabla(producto)}
                    </tr>
                `);
                $('#modal_datosDelProducto .btn-close').trigger('click');
                Swal.fire({
                    icon: "success",
                    title: "Listo",
                    text: "El producto fué creado exitosamente!"
                });
                offset += 1
            }
        });
    }
});

$('body').on('click', '.btn_editar_datosDelProducto', function() {
    console.log('Editar')
    const id = $('.form_datosDelproducto input[id=producto_id]').val();
    console.log(id);
    if(validateEditProduct()){
        var formData = new FormData($('.form_datosDelproducto')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: `/productos/${id}/update`, 
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                const producto = response.producto;
                let prod = JSON.stringify(producto);
                $(`.tbody_productosInventario .tr_inventario_${producto.id}`).html(`
                        <input class="inventario_input_producto" type="hidden" value='${prod}'>
                        ${productoEnLaTabla(producto)}
                `);
                $('#modal_datosDelProducto .btn-close').trigger('click');
                Swal.fire({
                    icon: "success",
                    title: "Listo",
                    text: "El producto fué editado exitosamente!"
                });
            },
        });
        
    }
});

$('body').on('click', '.btn_eliminarProducto_inventario', function(e) {
    e.preventDefault();
    const data_producto = $(this).closest('.tr_inventario').find('input').val();
    const producto = JSON.parse(data_producto);
    $('#confirmarEliminarProductoModal strong').text(`${producto.producto} ${producto.marca} ${producto.modelo}`);
    $('.btn_confirmar_eliminarProducto_inventario').data('id', producto.id);
});

$('body').on('click', '.btn_confirmar_eliminarProducto_inventario', function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: `/productos/${id}/delete`,
        success: function (response) {
            console.log(response)
            $('#confirmarEliminarProductoModal .btn-close').trigger('click');
            $('.tbody_productosInventario').find(`.tr_inventario_${id}`).remove();
            Swal.fire({
                icon: "success",
                title: "Hecho",
                text: "El producto ha sido eliminado exitosamente!"
            });
            if(offset>0){offset -= 1};
        }
    });
})