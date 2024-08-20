
<form id="form_editarProducto" class="form_edit_product"  method="POST" onsubmit="return validateEditProduct()" enctype="multipart/form-data"  style="display:flex; flex-direction:column; align-items:center; gap: 20px; padding: 20px; background-color:white; border: 1px solid rgb(218, 216, 216)">
    @csrf
    @method('PUT')
    <h1 class="text-center">Editar Registro</h1>
    <input id="producto_id" name="producto_id" class="producto_id" type="hidden" >
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="producto" class="form-label">Producto</label>
        <div id="div_input">
            <input id="producto" value="" type="text" name="producto" class="input edit_producto" tabindex="1">
            <p id="error">Debes insertar el nombre del producto</p>
        </div>
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="marca" class="form-label">Marca</label>
        <div id="div_input">
            <input id="marca" value="" type="text" name="marca" class="input edit_marca" tabindex="2">
            <p id="error">Debes insertar la marca del producto</p>
        </div>
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="modelo" class="form-label">Modelo</label>
        <div id="div_input">
            <input id="modelo" value="" type="text" name="modelo" class="input edit_modelo" tabindex="3">
            <p id="error">Debes insertar el modelo</p>
        </div>
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="sistema" class="form-label">Sistema Operativo</label>
        <div id="div_input">
            <input id="sistema" value="" type="text" name="sistema" class="input edit_sistema" tabindex="4">
            <p id="error">Debes insertar el sistema Operativo</p>
        </div>
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="imagen" class="form-label">Selecciona la imagen</label>
        <div id="div_input">
            <input id="imagen" value=""  type="file" name="imagen" class="edit_imagen" accept=".jpg,.jpeg,.png" tabindex="5"  >
            <p id="error">Debes adjuntar una imagen formato: jpg, jpeg o png</p>
        </div>
    </div>
    <div>
        <button type="submit" style="border-style:none; padding: 12px 30px; color:white; background-color:rgb(73, 199, 61)" tabindex="4">Editar</button>
        <a class="btn_edit_product_cancel a_editar"  style="text-decoration:none; padding: 10px 30px; color:white; background-color:rgb(104, 104, 104) " tabindex="5">Cancelar</a>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.btn_edit_product_cancel').click(function() {
            $('.form_edit_product')[0].reset();
            $('#producto').css('background-color', 'white'),
            $('#marca').css('background-color', 'white'),
            $('#modelo').css('background-color', 'white'),
            $('#sistema').css('background-color', 'white'),
            $('#imagen').css('background-color', 'white'),
            $('#imagen').css('border', 'none'),
            $('[id="error"]').hide(),
            $('#modal_editarProducto').hide()
        });
            /**
        $('.form_edit_product').submit(function(e){
            e.preventDefault();

            let id_producto = $('.producto_id').val();
            let formData = new FormData(this);

            console.log([...formData.entries()]);

            //validar datos
            if (validateEditProduct()) {
                $.ajax({
                    type: "PUT",
                    url: `/productos/${id_producto}/update`,
                    data: formData,
                    contentType: false,  // Evitar que jQuery defina el contentType (lo hará automáticamente)
                    processData: false,  // Evitar que jQuery procese el data
                    success: function (res) {
                        //const cliente = res.cliente;
                        $('.tbody_productos').html(res.html);
                        
                        //escodemos el modal crear cliente y lo reseteamos
                        $('.form_edit_product')[0].reset();
                        $('#modal_editarProducto').hide();

                        
                        alert('Producto Editado Exitosamente');
                    },
                    error: function (error) {
                        console.error('error', error);
                    }
                });
            };
        });
        */
    });
</script>