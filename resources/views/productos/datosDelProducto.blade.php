
        <form id="form_datosDelProducto" class="form_datosDelproducto"  method="POST" onsubmit="return validateEditProduct()" enctype="multipart/form-data">
        
            <input id="producto_id" name="producto_id" class="producto_id" type="hidden" >
            <div class="mb-3">
                <label for="producto" class="form-label">Producto</label>
                <div id="div_input">
                    <input id="producto" type="text" name="producto" class="form-control form-control-sm" tabindex="1">
                    <p id="error">Debes insertar el nombre del producto</p>
                </div>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <div id="div_input">
                    <input id="marca" type="text" name="marca" class="form-control form-control-sm" tabindex="2">
                    <p id="error">Debes insertar la marca del producto</p>
                </div>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <div id="div_input">
                    <input id="modelo" type="text" name="modelo" class="form-control form-control-sm" tabindex="3">
                    <p id="error">Debes insertar el modelo</p>
                </div>
            </div>
            <div class="mb-3">
                <label for="sistema" class="form-label">Sistema Operativo</label>
                <div id="div_input">
                    <input id="sistema" type="text" name="sistema" class="form-control form-control-sm" tabindex="4">
                    <p id="error">Debes insertar el sistema Operativo</p>
                </div>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <div id="div_input">
                    <input id="precio" type="text" name="precio" class="form-control form-control-sm" tabindex="4">
                    <p id="error">Debes insertar el precio</p>
                </div>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <div id="div_input">
                    <input id="cantidad" type="number" name="cantidad" class="form-control form-control-sm" tabindex="4">
                    <p id="error">Debes insertar el precio</p>
                </div>
            </div>
            <div class="mb-3">
                <div class="div_img_actual">
                </div>
                <label for="imagen" class="form-label">Selecciona la imagen</label>
                <div class="mb-3" id="div_input">
                    <input id="imagen" class="form-control form-control-sm" value="" name="imagen" type="file"accept=".jpg,.jpeg,.png" >
                    <p id="error">Debes adjuntar una imagen formato: jpg, jpeg o png</p>
                </div>
            </div>
            <div>
                <button type="submit" style="border-style:none; padding: 12px 30px; color:white; background-color:rgb(73, 199, 61)" tabindex="4">Editar</button>
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
            $('[id="error"]').hide()
        })
    });
</script>