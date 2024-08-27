
<form id="productsForm" class="form_create_product" enctype="multipart/form-data" style="background-color:white; border: 1px solid rgb(218, 216, 216) ">
    @csrf
    <h1 style="margin: 0">Crear Nuevo Producto</h1>
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
            <input id="precio" type="number" name="precio" class="form-control form-control-sm" tabindex="4">
            <p id="error">Debes insertar el precio</p>
        </div>
    </div>
    <div style="display: flex; flex-direction:column; gap:5px" class="mb-3">
        <label for="imagen" class="form-label">Selecciona la imagen</label>
        <input id="imagen" type="file" name="imagen" class="form-control" accept=".jpg,.jpeg,.png" tabindex="5"  >
        <p id="error">Debes adjuntar una imagen formato: jpg, jpeg o png</p>  
    </div>
    <div style="margin-top: 22px">
        <button id="btn-crear" type="submit" style="border-style:none;  padding: 12px 30px; color:white; background-color:rgb(73, 199, 61)" tabindex="6">Crear</button>
        <a id="btn-cancelar" class="btn_create_product_cancel a_editar" style="border-style:none; text-decoration:none; padding: 10px 30px; color:white; background-color:rgb(104, 104, 104)" tabindex="7">Cancelar</a>
    </div>
</form>



<script>
    $(document).ready(function () {
        $('.btn_create_product_cancel').click(function() {
            $('.form_create_product')[0].reset();
            $('#producto').css('background-color', 'white'),
            $('#marca').css('background-color', 'white'),
            $('#modelo').css('background-color', 'white'),
            $('#sistema').css('background-color', 'white'),
            $('#imagen').css('background-color', 'white'),
            $('#imagen').css('border', 'none'),
            $('[id="error"]').hide(),
            $('#modal_crearProducto').hide()
        });

        $('.form_create_product').on('submit', function(e){
            e.preventDefault();

            let formData = new FormData(this);

            //validar datos
            if (validateFormProduct()) {
                $.ajax({
                    type: "POST",
                    url: "/productos",
                    data: formData,
                    contentType: false,  // Evitar que jQuery defina el contentType (lo hará automáticamente)
                    processData: false,  // Evitar que jQuery procese el data
                    success: function (res) {
                        //const cliente = res.cliente;
                        $('.tbody_productos').html(res.html);
                        
                        //escodemos el modal crear cliente y lo reseteamos
                        $('.form_create_product')[0].reset();
                        $('#modal_crearProducto').hide();

                        
                        alert('Cliente Creado Exitosamente');
                    },
                    error: function (error) {
                        console.error('error', error);
                        console.log(error.responseJSON);
                    }
                });
            };
        });

    });
</script>