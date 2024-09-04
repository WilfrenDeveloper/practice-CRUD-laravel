
        <form id="form_editarProducto" class="form_edit_product"  method="POST" onsubmit="return validateEditProduct()" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input id="producto_id" name="producto_id" class="producto_id" type="hidden" >
            <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                <label for="producto" class="form-label">Producto</label>
                <div id="div_input">
                    <input id="producto" value="" type="text" name="producto" class="edit_producto form-control form-control-sm" tabindex="1">
                    <p id="error">Debes insertar el nombre del producto</p>
                </div>
            </div>
            <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <div id="div_input">
                    <input id="marca" value="" type="text" name="marca" class="edit_marca form-control form-control-sm" tabindex="2">
                    <p id="error">Debes insertar la marca del producto</p>
                </div>
            </div>
            <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <div id="div_input">
                    <input id="modelo" value="" type="text" name="modelo" class="edit_modelo form-control form-control-sm" tabindex="3">
                    <p id="error">Debes insertar el modelo</p>
                </div>
            </div>
            <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                <label for="sistema" class="form-label">Sistema Operativo</label>
                <div id="div_input">
                    <input id="sistema" value="" type="text" name="sistema" class="edit_sistema form-control form-control-sm" tabindex="4">
                    <p id="error">Debes insertar el sistema Operativo</p>
                </div>
            </div>
            <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <div id="div_input">
                    <input id="precio" value="" type="precio" name="precio" class="edit_precio form-control form-control-sm" tabindex="4">
                    <p id="error">Debes insertar el precio</p>
                </div>
            </div>
            <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
                <label for="edit_imagen">Imagen actual:</label>
                <img src="" alt="Imagen actual" id="img_actual" style="max-width:80px; max-height:80px;">
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
            $('[id="error"]').hide()
        })
    });
</script>